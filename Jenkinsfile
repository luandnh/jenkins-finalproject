pipeline {
  agent none
  parameters {
    choice(
    name: 'PROJECT', choices: ['ALL', 'NODEJS', 'PYTHON'], description: 'PROJECT TO CI/CD')
  }
  environment {
    DOCKERHUB_PW = credentials('dockerhub_pw')
    DOCKERHUB_USER = 'luandnh1998'
  }
  stages {
    stage("Build") {
      agent {
        label 'node1'
      }
      steps {
        script {
          switch (params.PROJECT) {
          case "NODEJS":
            echo "NodeJS GIT"
            env.DOCKER_IMAGE = "luandnh1998/nodejs"
            git 'https://github.com/luandnh/node-hello.git';
            sh './jenkins/build.sh'
            break
          case "PYTHON":
            echo "Python GIT"
            env.DOCKER_IMAGE = "luandnh1998/pythonhello"
            git 'https://github.com/luandnh/python-hello.git';
            sh './jenkins/build.sh'
            break
          case "ALL":
            echo "NodeJS GIT"
            env.DOCKER_IMAGE = "luandnh1998/nodejs"
            git 'https://github.com/luandnh/node-hello.git';
            sh './jenkins/build.sh'
            echo "Python GIT"
            env.DOCKER_IMAGE = "luandnh1998/pythonhello"
            git 'https://github.com/luandnh/python-hello.git';
            sh './jenkins/build.sh'
            break
          }
        }
      }
    }
    stage("Deploy") {
      agent {
        label 'node2'
      }
      steps {
        script {
          sh "hostname -f > hostname.txt"
          def hostname = readFile(file: 'hostname.txt')
          env.HOST_NAME = hostname
          switch (params.PROJECT) {
          case "NODEJS":
            echo "NodeJS GIT"
            env.DOCKER_IMAGE = "luandnh1998/nodejs"
            git 'https://github.com/luandnh/node-hello.git';
            sh './scripts/remove_old_container.sh'
            sh './jenkins/deploy.sh'
            break
          case "PYTHON":
            echo "Python GIT"
            env.DOCKER_IMAGE = "luandnh1998/pythonhello"
            git 'https://github.com/luandnh/python-hello.git';
            sh './scripts/remove_old_container.sh'
            sh './jenkins/deploy.sh'
            break
          case "ALL":
            echo "NodeJS GIT"
            env.DOCKER_IMAGE = "luandnh1998/nodejs"
            git 'https://github.com/luandnh/node-hello.git';
            sh './scripts/remove_old_container.sh'
            sh './jenkins/deploy.sh'
            echo "Python GIT"
            env.DOCKER_IMAGE = "luandnh1998/pythonhello"
            git 'https://github.com/luandnh/python-hello.git';
            sh './scripts/remove_old_container.sh'
            sh './jenkins/deploy.sh'
            break
          }
        }
      }
    }
  }
}