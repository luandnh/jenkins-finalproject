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
                    switch(params.PROJECT) {
                        case "NODEJS": git 'https://github.com/luandnh/node-hello.git'; break
                        case "PYTHON": git 'https://github.com/luandnh/python-hello.git'; break
                        case "ALL": 
                            git 'https://github.com/luandnh/node-hello.git';
                            git 'https://github.com/luandnh/python-hello.git';
                            break
                    }
                }
            }
        }
  }
}