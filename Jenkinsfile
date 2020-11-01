pipeline {
  agent none
  parameters {
    choice(
      name: 'PROJECT',
      choices: ['ALL', 'NODEJS', 'PYTHON'],
      description: 'PROJECT TO CI/CD'
    )
  }
  stages {
        stage("GIT") {
            steps {
                script {
                    if (params.PROJECT== "NODEJS") {
                        echo "NODEJS"
                    } 
                    } else if (params.PROJECT== "PYTHON") {
                        echo "PYTHON"
                    } else {
                        echo "ALL"
                    }
                }
            }
        }
  }
}