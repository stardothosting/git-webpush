#!/bin/bash

datetime=`date "+%Y-%m-%d %H:%M:%S"`

#$1 = Argument passed that is the site to be pushed
#$2 = Argument passed that is the respective branch name

# Push www.blogto.com to DEV
if [ "$1" = "www.dev" ]
then
	#Enter rsync commands and git pull, copy from the git folder to the dev site folder 
	#Example :
        #cd /data/git-repository/webapp
        #echo "Pulling from branch: $2"
        #sudo -u gituser git fetch --all
        #sudo -u gituser git checkout $2
        #sudo -u gituser git pull origin $2



# Push to PRODUCTION
elif [ "$1" = "www.prod" ]
then
	#Enter rsync commants to copy from the dev site folder to the production site folder

else
	echo "Wrong argument passed, exiting"
	exit 1
fi

exit 0

