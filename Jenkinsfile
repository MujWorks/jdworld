pipeline {
    agent any
    environment{
        staging_server="144.126.230.211"
    }
    stages {
        stage('Deploy PHP Application') {
            steps {
                 // For DIfferent machine
                //sh 'scp -r ${WORKSPACE}/* root@${staging_server}:/var/www/html/simplecrud/'

                script {
                    //def remoteDir = "/var/www/html/simplecrud/"
                    def remoteDir = "/var/www/html/"
                    
                        //  create directory
                        //sh "sudo mkdir -p ${remoteDir}"
                    
                    
                    // Now, copy the files
                    sh "sudo cp -r ${WORKSPACE}/* ${remoteDir}"

                    // Set permissions for the Jenkins user
                    sh "sudo chown -R jenkins:jenkins ${remoteDir}"
                    sh "sudo chmod -R 755 ${remoteDir}"
                }
            }
        }
    }
}
