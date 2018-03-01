#!/usr/bin/env bash

function usage {
  echo "Usage: $0 <PHP/PATH>" 1>&2
  exit 1
}

if [ -z "$1" ]
then
    echo -e "\033[31mPHP executable path must be defined as first argument\033[0m"
    usage
fi

STATUS=0
TEST_RES=""

PHP=$1

function runner {
    TEST_RES=`$1`
    local TEST_RET=$?
}

function test {
    TEST_RES=`$1`
    local TEST_RET=$?

    if [ $TEST_RET != 0 ]
    then
        echo -e "\033[31m$2 FAILED\033[0m"

        echo "$TEST_RES"

        STATUS=$((STATUS + $3))
    else
        echo -e "\033[32m$2 SUCCESS\033[0m"
    fi
}

if [ ! -d "doc" ]
then
    mkdir -p "doc"
fi

runner "$PHP vendor/bin/phpcbf --standard=PSR2 src/"
echo "$TEST_RES" > doc/phpcbf.txt

test "$PHP vendor/bin/phpunit" PHPUnit 100
echo "$TEST_RES" > doc/phpunit.txt

test "$PHP vendor/bin/phpcs --standard=PSR2 src/" PHPCS 100
echo "$TEST_RES" > doc/phpcs.txt

test "$PHP vendor/bin/phpmd src/ text ./phpmd.xml" PHPMD 100
echo "$TEST_RES" > doc/phpmd.txt

test "$PHP vendor/bin/phpcpd src/" PHPCPD 1
echo "$TEST_RES" > doc/phpcpd.txt

#test "$PHP vendor/bin/sami.php update samiConfig.php" SAMI 1
#echo "$TEST_RES" > doc/phpcpd.txt

runner "$PHP vendor/bin/phpcs src/"
echo "$TEST_RES" > doc/phpcs_all.txt

if [ "$STATUS" -eq 0 ]
then
    echo -e "\n\033[42m"
    echo -e "\033[30mTHE STATUS IS STABLE\n\033[0m\n\033[49m"

elif [ "$STATUS" -lt 100 ]
then
    echo -e "\n\033[43m"
    echo -e "\033[30mTHE STATUS IS UNSTABLE\n\e[0m\n\033[49m"
else
    echo -e "\n\033[41m"
    echo -e "\033[30mTHE STATUS IS FAILURE\n\033[0m\n\033[49m"
fi

exit $STATUS
