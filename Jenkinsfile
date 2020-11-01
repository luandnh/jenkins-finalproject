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
                    switch(params.DEPLOY_TO) {
                        case "NODEJS": echo "NODEJS"; break
                        case "PYTHON": echo "PYTHON"; break
                        case "ALL": echo "ALL"; break
                    }
                }
            }
        }
  }
}