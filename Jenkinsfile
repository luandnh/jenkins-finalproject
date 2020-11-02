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
      parallel {
        stage("Build NodeJS") {
          when {
            expression {
              params.PROJECT == 'NODEJS' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "NodeJS GIT";
            env.DOCKER_IMAGE = "luandnh1998/nodejs";
            git 'https://github.com/luandnh/node-hello.git';
            sh './jenkins/build.sh';
          }
        }
        stage("Build Python") {
          when {
            expression {
              params.PROJECT == 'PYTHON' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "Python GIT"
            env.DOCKER_IMAGE = "luandnh1998/pythonhello";
            git 'https://github.com/luandnh/python-hello.git';
            sh './jenkins/build.sh';
          }
        }
      }
    }

    stage("Deploy") {
      agent {
        label 'node2'
      }
      parallel {
        stage("Deploy NodeJS") {
          when {
            expression {
              params.PROJECT == 'NODEJS' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "NodeJS GIT";
            env.DOCKER_IMAGE = "luandnh1998/nodejs";
            git 'https://github.com/luandnh/node-hello.git';
            echo "Remove Old Container";
            sh './scripts/remove_old_container.sh';
            sh './jenkins/deploy.sh';
          }
        }
        stage("Deploy Python") {
          when {
            expression {
              params.PROJECT == 'PYTHON' || params.PROJECT == 'ALL'
            }
          }
          steps {
            echo "Python GIT";
            env.DOCKER_IMAGE = "luandnh1998/pythonhello";
            git 'https://github.com/luandnh/python-hello.git';
            echo "Remove Old Container";
            sh './scripts/remove_old_container.sh';
            sh './jenkins/deploy.sh';
          }
        }
      }
    }
  }
}