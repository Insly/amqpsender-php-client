#!/bin/bash

#
# Run the code deep checker on project source BEFORE PUSHING
# and fix all detected errors manually
#
# Run examples
#
#   a) Just check the code
#       ./run_ecs_check.sh
#
#   b) Fix the style errors
#       ./run_ecs_check.sh --fix

DOCKER_CMD=$(which docker)
BASE_CMD=$(cat << EOC
$DOCKER_CMD run --init --rm -it \
    -v $(pwd):/project -v $(pwd)/tmp-phpqa:/tmp -w /project \
    jakzal/phpqa:php7.4-alpine
EOC
)

$BASE_CMD phpstan analyse --level 5 src
#$BASE_CMD phpinsights -v analyse -n -s src $@

# shellcheck disable=SC2046
$DOCKER_CMD run --rm -it --entrypoint sh -v $(pwd):/var/www -w /var/www jakzal/phpqa:php7.4-alpine -c "ecs check ./src $@; exit"

echo "Done!"
