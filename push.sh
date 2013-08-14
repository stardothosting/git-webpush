#!/bin/bash

datetime=`date "+%Y-%m-%d %H:%M:%S"`

# Push www.blogto.com to DEV
if [ "$1" = "www.dev" ]
then
	#Enter rsync commands to git pull, copy from the git folder to the dev site folder 


# Push www.blogto.com to PRODUCTION
elif [ "$1" = "www.prod" ]
then
	#Enter rsync commants to copy from the dev site folder to the production site folder

else
	echo "Wrong argument passed, exiting"
	exit 1
fi

exit 0

