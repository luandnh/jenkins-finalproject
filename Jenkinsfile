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
            agent { label 'node1' }
            steps {
                script {
                    switch(params.PROJECT) {
                        case "NODEJS": git 'https://github.com/luandnh/node-hello.git'; break
                        case "PYTHON": git 'https://github.com/luandnh/python-hello.git'; break
                        case "ALL": 
                            echo "NodeJS GIT"
                            git 'https://github.com/luandnh/node-hello.git';
                            echo "Python GIT"
                            git 'https://github.com/luandnh/python-hello.git';
                            break
                    }
                }
            }
        }
  }
}