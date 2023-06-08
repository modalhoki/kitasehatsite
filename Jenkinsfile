pipeline {
    agent any
    stages {
        stage('Delete the old container') {
            steps {
                echo 'Deleting old container'
                sh 'docker rm -f kitasehat-webportal'
            }
        }

        stage('Delete unused image') {
            steps {
                echo 'Deleting unused images'
                sh 'docker image prune -a -f'
            }
        }

        stage('Build the image') {
            steps {
                echo 'Building the image'
                sh 'docker build -t ghcr.io/modalhoki/kitasehat-webportal:latest .'
            }
        }

        stage('Run the container') {
            steps {
                echo 'Running the container'
                sh 'docker run -d --name kitasehat-webportal -p 3002:80 ghcr.io/modalhoki/kitasehat-webportal:latest --restart always'
            }
        }

        stage('Check wether the container is running or not') {
            steps {
                echo 'Checking the container'
                sh 'docker ps'
            }
        }

        stage('Clear docker cache') {
            steps {
                echo 'Clearing docker cache'
                sh 'docker builder prune -a -f'
            }
        }
    }
}