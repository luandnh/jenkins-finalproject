pipeline {
  agent none
  parameters {
    choice(
    name: 'PROJECT', choices: ['ALL', 'NODEJS', 'PYTHON'], description: 'PROJECT TO CI/CD')
  }
  environment {
    DOCKER_IMAGE = 'luandnh1998/pythonhello'
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
            git 'https://github.com/luandnh/node-hello.git';
            sh 'docker build -t ${DOCKER_IMAGE}:${BUILD_ID} .';
            sh 'docker tag ${DOCKER_IMAGE}:${BUILD_ID} ${DOCKER_IMAGE}:lastest';
            break
          case "PYTHON":
            echo "Python GIT"
            git 'https://github.com/luandnh/python-hello.git';
            sh 'docker build -t ${DOCKER_IMAGE}:${BUILD_ID} .';
            sh 'docker tag ${DOCKER_IMAGE}:${BUILD_ID} ${DOCKER_IMAGE}:lastest';
            break
          case "ALL":
            echo "NodeJS GIT"
            git 'https://github.com/luandnh/node-hello.git';
            sh 'docker build -t ${DOCKER_IMAGE}:${BUILD_ID} .';
            sh 'docker tag ${DOCKER_IMAGE}:${BUILD_ID} ${DOCKER_IMAGE}:lastest';
            echo "Python GIT"
            git 'https://github.com/luandnh/python-hello.git';
            sh 'docker build -t ${DOCKER_IMAGE}:${BUILD_ID} .';
            sh 'docker tag ${DOCKER_IMAGE}:${BUILD_ID} ${DOCKER_IMAGE}:lastest';
            break
          }
        }
      }
    }
  }
}