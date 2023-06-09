<?php

namespace PHPMaker2021\Kitasehat;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PasienSearch extends Pasien
{
    use MessagesTrait;

    // Page ID
    public $PageID = "search";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pasien';

    // Page object name
    public $PageObjName = "PasienSearch";

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (pasien)
        if (!isset($GLOBALS["pasien"]) || get_class($GLOBALS["pasien"]) == PROJECT_NAMESPACE . "pasien") {
            $GLOBALS["pasien"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pasien');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("pasien"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "pasienview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $FormClassName = "ew-horizontal ew-form ew-search-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->setVisibility();
        $this->nik->setVisibility();
        $this->nama->setVisibility();
        $this->jenis_kelamin->setVisibility();
        $this->tanggal_lahir->setVisibility();
        $this->agama->setVisibility();
        $this->pekerjaan->setVisibility();
        $this->pendidikan->setVisibility();
        $this->status_perkawinan->setVisibility();
        $this->no_bpjs->setVisibility();
        $this->no_hp->setVisibility();
        $this->_password->setVisibility();
        $this->foto_profil->setVisibility();
        $this->foto_profil_par_id->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        if ($this->isPageRequest()) {
            // Get action
            $this->CurrentAction = Post("action");
            if ($this->isSearch()) {
                // Build search string for advanced search, remove blank field
                $this->loadSearchValues(); // Get search values
                if ($this->validateSearch()) {
                    $srchStr = $this->buildAdvancedSearch();
                } else {
                    $srchStr = "";
                }
                if ($srchStr != "") {
                    $srchStr = $this->getUrlParm($srchStr);
                    $srchStr = "pasienlist" . "?" . $srchStr;
                    $this->terminate($srchStr); // Go to list page
                    return;
                }
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Render row for search
        $this->RowType = ROWTYPE_SEARCH;
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Build advanced search
    protected function buildAdvancedSearch()
    {
        $srchUrl = "";
        $this->buildSearchUrl($srchUrl, $this->id); // id
        $this->buildSearchUrl($srchUrl, $this->nik); // nik
        $this->buildSearchUrl($srchUrl, $this->nama); // nama
        $this->buildSearchUrl($srchUrl, $this->jenis_kelamin); // jenis_kelamin
        $this->buildSearchUrl($srchUrl, $this->tanggal_lahir); // tanggal_lahir
        $this->buildSearchUrl($srchUrl, $this->agama); // agama
        $this->buildSearchUrl($srchUrl, $this->pekerjaan); // pekerjaan
        $this->buildSearchUrl($srchUrl, $this->pendidikan); // pendidikan
        $this->buildSearchUrl($srchUrl, $this->status_perkawinan); // status_perkawinan
        $this->buildSearchUrl($srchUrl, $this->no_bpjs); // no_bpjs
        $this->buildSearchUrl($srchUrl, $this->no_hp); // no_hp
        $this->buildSearchUrl($srchUrl, $this->_password); // password
        $this->buildSearchUrl($srchUrl, $this->foto_profil); // foto_profil
        $this->buildSearchUrl($srchUrl, $this->foto_profil_par_id); // foto_profil_par_id
        if ($srchUrl != "") {
            $srchUrl .= "&";
        }
        $srchUrl .= "cmd=search";
        return $srchUrl;
    }

    // Build search URL
    protected function buildSearchUrl(&$url, &$fld, $oprOnly = false)
    {
        global $CurrentForm;
        $wrk = "";
        $fldParm = $fld->Param;
        $fldVal = $CurrentForm->getValue("x_$fldParm");
        $fldOpr = $CurrentForm->getValue("z_$fldParm");
        $fldCond = $CurrentForm->getValue("v_$fldParm");
        $fldVal2 = $CurrentForm->getValue("y_$fldParm");
        $fldOpr2 = $CurrentForm->getValue("w_$fldParm");
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr));
        $fldDataType = ($fld->IsVirtual) ? DATATYPE_STRING : $fld->DataType;
        if ($fldOpr == "BETWEEN") {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal) && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal != "" && $fldVal2 != "" && $isValidValue) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            }
        } else {
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal));
            if ($fldVal != "" && $isValidValue && IsValidOperator($fldOpr, $fldDataType)) {
                $wrk = "x_" . $fldParm . "=" . urlencode($fldVal) .
                    "&z_" . $fldParm . "=" . urlencode($fldOpr);
            } elseif ($fldOpr == "IS NULL" || $fldOpr == "IS NOT NULL" || ($fldOpr != "" && $oprOnly && IsValidOperator($fldOpr, $fldDataType))) {
                $wrk = "z_" . $fldParm . "=" . urlencode($fldOpr);
            }
            $isValidValue = ($fldDataType != DATATYPE_NUMBER) ||
                ($fldDataType == DATATYPE_NUMBER && $this->searchValueIsNumeric($fld, $fldVal2));
            if ($fldVal2 != "" && $isValidValue && IsValidOperator($fldOpr2, $fldDataType)) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "y_" . $fldParm . "=" . urlencode($fldVal2) .
                    "&w_" . $fldParm . "=" . urlencode($fldOpr2);
            } elseif ($fldOpr2 == "IS NULL" || $fldOpr2 == "IS NOT NULL" || ($fldOpr2 != "" && $oprOnly && IsValidOperator($fldOpr2, $fldDataType))) {
                if ($wrk != "") {
                    $wrk .= "&v_" . $fldParm . "=" . urlencode($fldCond) . "&";
                }
                $wrk .= "w_" . $fldParm . "=" . urlencode($fldOpr2);
            }
        }
        if ($wrk != "") {
            if ($url != "") {
                $url .= "&";
            }
            $url .= $wrk;
        }
    }

    // Check if search value is numeric
    protected function searchValueIsNumeric($fld, $value)
    {
        if (IsFloatFormat($fld->Type)) {
            $value = ConvertToFloatString($value);
        }
        return is_numeric($value);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;
        if ($this->id->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->nik->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->nama->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->jenis_kelamin->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->tanggal_lahir->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->agama->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->pekerjaan->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->pendidikan->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->status_perkawinan->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->no_bpjs->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->no_hp->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->_password->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->foto_profil->AdvancedSearch->post()) {
            $hasValue = true;
        }
        if ($this->foto_profil_par_id->AdvancedSearch->post()) {
            $hasValue = true;
        }
        return $hasValue;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // nik

        // nama

        // jenis_kelamin

        // tanggal_lahir

        // agama

        // pekerjaan

        // pendidikan

        // status_perkawinan

        // no_bpjs

        // no_hp

        // password

        // foto_profil

        // foto_profil_par_id
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // jenis_kelamin
            if (strval($this->jenis_kelamin->CurrentValue) != "") {
                $this->jenis_kelamin->ViewValue = $this->jenis_kelamin->optionCaption($this->jenis_kelamin->CurrentValue);
            } else {
                $this->jenis_kelamin->ViewValue = null;
            }
            $this->jenis_kelamin->ViewCustomAttributes = "";

            // tanggal_lahir
            $this->tanggal_lahir->ViewValue = $this->tanggal_lahir->CurrentValue;
            $this->tanggal_lahir->ViewValue = FormatDateTime($this->tanggal_lahir->ViewValue, 0);
            $this->tanggal_lahir->ViewCustomAttributes = "";

            // agama
            if (strval($this->agama->CurrentValue) != "") {
                $this->agama->ViewValue = $this->agama->optionCaption($this->agama->CurrentValue);
            } else {
                $this->agama->ViewValue = null;
            }
            $this->agama->ViewCustomAttributes = "";

            // pekerjaan
            if (strval($this->pekerjaan->CurrentValue) != "") {
                $this->pekerjaan->ViewValue = $this->pekerjaan->optionCaption($this->pekerjaan->CurrentValue);
            } else {
                $this->pekerjaan->ViewValue = null;
            }
            $this->pekerjaan->ViewCustomAttributes = "";

            // pendidikan
            if (strval($this->pendidikan->CurrentValue) != "") {
                $this->pendidikan->ViewValue = $this->pendidikan->optionCaption($this->pendidikan->CurrentValue);
            } else {
                $this->pendidikan->ViewValue = null;
            }
            $this->pendidikan->ViewCustomAttributes = "";

            // status_perkawinan
            if (strval($this->status_perkawinan->CurrentValue) != "") {
                $this->status_perkawinan->ViewValue = $this->status_perkawinan->optionCaption($this->status_perkawinan->CurrentValue);
            } else {
                $this->status_perkawinan->ViewValue = null;
            }
            $this->status_perkawinan->ViewCustomAttributes = "";

            // no_bpjs
            $this->no_bpjs->ViewValue = $this->no_bpjs->CurrentValue;
            $this->no_bpjs->ViewCustomAttributes = "";

            // no_hp
            $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
            $this->no_hp->ViewCustomAttributes = "";

            // password
            $this->_password->ViewValue = $Language->phrase("PasswordMask");
            $this->_password->ViewCustomAttributes = "";

            // foto_profil
            $this->foto_profil->ViewValue = $this->foto_profil->CurrentValue;
            $this->foto_profil->ViewCustomAttributes = "";

            // foto_profil_par_id
            $this->foto_profil_par_id->ViewValue = $this->foto_profil_par_id->CurrentValue;
            $this->foto_profil_par_id->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";
            $this->nama->TooltipValue = "";

            // jenis_kelamin
            $this->jenis_kelamin->LinkCustomAttributes = "";
            $this->jenis_kelamin->HrefValue = "";
            $this->jenis_kelamin->TooltipValue = "";

            // tanggal_lahir
            $this->tanggal_lahir->LinkCustomAttributes = "";
            $this->tanggal_lahir->HrefValue = "";
            $this->tanggal_lahir->TooltipValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";
            $this->agama->TooltipValue = "";

            // pekerjaan
            $this->pekerjaan->LinkCustomAttributes = "";
            $this->pekerjaan->HrefValue = "";
            $this->pekerjaan->TooltipValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";
            $this->pendidikan->TooltipValue = "";

            // status_perkawinan
            $this->status_perkawinan->LinkCustomAttributes = "";
            $this->status_perkawinan->HrefValue = "";
            $this->status_perkawinan->TooltipValue = "";

            // no_bpjs
            $this->no_bpjs->LinkCustomAttributes = "";
            $this->no_bpjs->HrefValue = "";
            $this->no_bpjs->TooltipValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";
            $this->no_hp->TooltipValue = "";

            // password
            $this->_password->LinkCustomAttributes = "";
            $this->_password->HrefValue = "";
            $this->_password->TooltipValue = "";

            // foto_profil
            $this->foto_profil->LinkCustomAttributes = "";
            if (!EmptyValue($this->foto_profil->CurrentValue)) {
                $this->foto_profil->HrefValue = $this->foto_profil->CurrentValue; // Add prefix/suffix
                $this->foto_profil->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->foto_profil->HrefValue = FullUrl($this->foto_profil->HrefValue, "href");
                }
            } else {
                $this->foto_profil->HrefValue = "";
            }
            $this->foto_profil->TooltipValue = "";

            // foto_profil_par_id
            $this->foto_profil_par_id->LinkCustomAttributes = "";
            $this->foto_profil_par_id->HrefValue = "";
            $this->foto_profil_par_id->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = HtmlEncode($this->id->AdvancedSearch->SearchValue);
            $this->id->PlaceHolder = RemoveHtml($this->id->caption());

            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->AdvancedSearch->SearchValue = HtmlDecode($this->nik->AdvancedSearch->SearchValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->AdvancedSearch->SearchValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // nama
            $this->nama->EditAttrs["class"] = "form-control";
            $this->nama->EditCustomAttributes = "";
            if (!$this->nama->Raw) {
                $this->nama->AdvancedSearch->SearchValue = HtmlDecode($this->nama->AdvancedSearch->SearchValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // jenis_kelamin
            $this->jenis_kelamin->EditCustomAttributes = "";
            $this->jenis_kelamin->EditValue = $this->jenis_kelamin->options(false);
            $this->jenis_kelamin->PlaceHolder = RemoveHtml($this->jenis_kelamin->caption());

            // tanggal_lahir
            $this->tanggal_lahir->EditAttrs["class"] = "form-control";
            $this->tanggal_lahir->EditCustomAttributes = "";
            $this->tanggal_lahir->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->tanggal_lahir->AdvancedSearch->SearchValue, 0), 8));
            $this->tanggal_lahir->PlaceHolder = RemoveHtml($this->tanggal_lahir->caption());

            // agama
            $this->agama->EditCustomAttributes = "";
            $this->agama->EditValue = $this->agama->options(false);
            $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

            // pekerjaan
            $this->pekerjaan->EditCustomAttributes = "";
            $this->pekerjaan->EditValue = $this->pekerjaan->options(false);
            $this->pekerjaan->PlaceHolder = RemoveHtml($this->pekerjaan->caption());

            // pendidikan
            $this->pendidikan->EditCustomAttributes = "";
            $this->pendidikan->EditValue = $this->pendidikan->options(false);
            $this->pendidikan->PlaceHolder = RemoveHtml($this->pendidikan->caption());

            // status_perkawinan
            $this->status_perkawinan->EditCustomAttributes = "";
            $this->status_perkawinan->EditValue = $this->status_perkawinan->options(false);
            $this->status_perkawinan->PlaceHolder = RemoveHtml($this->status_perkawinan->caption());

            // no_bpjs
            $this->no_bpjs->EditAttrs["class"] = "form-control";
            $this->no_bpjs->EditCustomAttributes = "";
            if (!$this->no_bpjs->Raw) {
                $this->no_bpjs->AdvancedSearch->SearchValue = HtmlDecode($this->no_bpjs->AdvancedSearch->SearchValue);
            }
            $this->no_bpjs->EditValue = HtmlEncode($this->no_bpjs->AdvancedSearch->SearchValue);
            $this->no_bpjs->PlaceHolder = RemoveHtml($this->no_bpjs->caption());

            // no_hp
            $this->no_hp->EditAttrs["class"] = "form-control";
            $this->no_hp->EditCustomAttributes = "";
            if (!$this->no_hp->Raw) {
                $this->no_hp->AdvancedSearch->SearchValue = HtmlDecode($this->no_hp->AdvancedSearch->SearchValue);
            }
            $this->no_hp->EditValue = HtmlEncode($this->no_hp->AdvancedSearch->SearchValue);
            $this->no_hp->PlaceHolder = RemoveHtml($this->no_hp->caption());

            // password
            $this->_password->EditAttrs["class"] = "form-control";
            $this->_password->EditCustomAttributes = "";
            $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

            // foto_profil
            $this->foto_profil->EditAttrs["class"] = "form-control";
            $this->foto_profil->EditCustomAttributes = "";
            if (!$this->foto_profil->Raw) {
                $this->foto_profil->AdvancedSearch->SearchValue = HtmlDecode($this->foto_profil->AdvancedSearch->SearchValue);
            }
            $this->foto_profil->EditValue = HtmlEncode($this->foto_profil->AdvancedSearch->SearchValue);
            $this->foto_profil->PlaceHolder = RemoveHtml($this->foto_profil->caption());

            // foto_profil_par_id
            $this->foto_profil_par_id->EditAttrs["class"] = "form-control";
            $this->foto_profil_par_id->EditCustomAttributes = "";
            if (!$this->foto_profil_par_id->Raw) {
                $this->foto_profil_par_id->AdvancedSearch->SearchValue = HtmlDecode($this->foto_profil_par_id->AdvancedSearch->SearchValue);
            }
            $this->foto_profil_par_id->EditValue = HtmlEncode($this->foto_profil_par_id->AdvancedSearch->SearchValue);
            $this->foto_profil_par_id->PlaceHolder = RemoveHtml($this->foto_profil_par_id->caption());
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if (!CheckInteger($this->id->AdvancedSearch->SearchValue)) {
            $this->id->addErrorMessage($this->id->getErrorMessage(false));
        }
        if (!CheckDate($this->tanggal_lahir->AdvancedSearch->SearchValue)) {
            $this->tanggal_lahir->addErrorMessage($this->tanggal_lahir->getErrorMessage(false));
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->id->AdvancedSearch->load();
        $this->nik->AdvancedSearch->load();
        $this->nama->AdvancedSearch->load();
        $this->jenis_kelamin->AdvancedSearch->load();
        $this->tanggal_lahir->AdvancedSearch->load();
        $this->agama->AdvancedSearch->load();
        $this->pekerjaan->AdvancedSearch->load();
        $this->pendidikan->AdvancedSearch->load();
        $this->status_perkawinan->AdvancedSearch->load();
        $this->no_bpjs->AdvancedSearch->load();
        $this->no_hp->AdvancedSearch->load();
        $this->_password->AdvancedSearch->load();
        $this->foto_profil->AdvancedSearch->load();
        $this->foto_profil_par_id->AdvancedSearch->load();
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pasienlist"), "", $this->TableVar, true);
        $pageId = "search";
        $Breadcrumb->add("search", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_jenis_kelamin":
                    break;
                case "x_agama":
                    break;
                case "x_pekerjaan":
                    break;
                case "x_pendidikan":
                    break;
                case "x_status_perkawinan":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
