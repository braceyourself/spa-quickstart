@servers(['as1'=>'192.168.0.4',	'localhost'=>'127.0.0.1'])

<?php
$local_dir = "/mnt/c/Users/ethan/Code/api.braceyourself.solutions";

$site_name = 'api.braceyourself.solutions';
$repo = "/var/git/$site_name.git";
$var_www_APP_NAME = "/var/www/$site_name";
$var_www_releases_APP_NAME = "/var/www/releases/$site_name";
$var_www_APP_NAME_app = $var_www_APP_NAME . '/app';
$php_version = 'php7.2';
$release = date('Y-M-d_H:i:s');

$ENV_FILE = "$var_www_APP_NAME/.env";
$ENV_EXAMPLE = "$var_www_releases_APP_NAME/$release/.env.example";
?>

@macro('dev', ['on' => 'as1'])
	identify
	fetch_repo
	create_folders
	update_permissions
	update_symlinks
	run_composer
	npm
	clear_cache
	log_release
@endmacro


@macro('push', ['on' => 'as1'])
	identify
    pull
	create_folders
	update_symlinks_current
	composer
	update_permissions_current
	clear_cache_current_release
	migrate_current
	
@endmacro


@macro('deploy', ['on' => 'as1'])

	identify
	fetch_repo
	create_folders
	update_permissions
	update_symlinks
	run_composer
	npm
	clear_cache
	enable_site
	migrate
	log_release

@endmacro


@task('identify')
	echo "TASK: identify"
	echo "logged into $(hostname) as $(whoami)"
@endtask

@task('pull')
	cd {{$var_www_APP_NAME_app}};
	git reset --hard
	git pull;
@endtask

@task('fetch_repo')
	echo "TASK: fetch_repo"

	if [ ! -d {{$repo}} ];then
		mkdir {{$repo}}
		cd {{$repo}}
		git init --bare
	fi

	[ -d {{$var_www_releases_APP_NAME}} ] || mkdir {{$var_www_releases_APP_NAME}} ;
	cd {{$var_www_releases_APP_NAME}};

	git clone -b master {{ $repo }} "{{ $release }}";
@endtask



@task('create_folders', ['on' => 'as1'])
	echo "TASK: create_folders"

	sudo chown -R ethan:www-data {{$var_www_APP_NAME}}

	mkdir -p {{$var_www_APP_NAME}}/storage/framework/cache/data

	cd {{$var_www_APP_NAME}}/storage/framework
	mkdir -p sessions
	mkdir -p views
	mkdir -p cache

@endtask






@task('update_permissions_current')
	echo "TASK: update_permissions_current"

	echo "cd {{ $var_www_APP_NAME }}"
	cd {{ $var_www_APP_NAME }};

	echo "sudo chmod -R 775 'app'"
	sudo chmod -R 775 "app";

	echo "sudo chgrp -R www-data 'app'"
	sudo chgrp -R www-data "app";

@endtask

@task('update_permissions')
	echo "TASK: update_permissions"

	echo "cd {{ $var_www_releases_APP_NAME }}"
	cd {{ $var_www_releases_APP_NAME }};

	if [ ! -d {{$release}} ]; then
		mkdir {{$release}};
	fi

	echo "sudo chmod -R 775 '{{ $release }}'"
	sudo chmod -R 775 "{{ $release }}";

	echo "sudo chgrp -R www-data '{{ $release }}'"
	sudo chgrp -R www-data "{{ $release }}";

@endtask






@task('log_release')
	echo "task: log_release"

	cd {{ $var_www_releases_APP_NAME }}
	echo {{ $release }} >> release_log
@endtask


@task('list_releases')
	echo "task: list_releases"

	cat {{ $var_www_releases_APP_NAME }}/log

@endtask



@task('run_composer')
	echo "task: run_composer"

	cd {{ $var_www_releases_APP_NAME }}/"{{ $release }}";
	composer install --prefer-dist --no-scripts --no-dev;
	php artisan clear-compiled --env=production;
	composer dump-autoload -o
@endtask

@task('composer')
	echo "task: run_composer"

	cd {{ $var_www_APP_NAME_app }}
	composer install --prefer-dist --no-scripts --no-dev;
	php artisan clear-compiled --env=production;
	composer dump-autoload -o
@endtask


@task('migrate')
	echo "task: migrate"

	cd {{ $var_www_releases_APP_NAME }}/"{{ $release }}";
	php artisan migrate --force;
@endtask

@task('migrate_current')
	echo "task: migrate_current"

	cd {{ $var_www_APP_NAME_app }}
	php artisan migrate --force;
@endtask



@task('npm')
	echo "task: npm"
	cd {{ $var_www_releases_APP_NAME }}/{{$release}}

	npm install
	npm run prod
@endtask

@task('update_symlinks')

echo "task: update_symlinks"

cd {{ $var_www_APP_NAME }};



# link .env
ln -nfs {{ $var_www_APP_NAME }}/.env {{ $var_www_releases_APP_NAME }}/{{$release}}/.env;


# link storage
rm -r {{ $var_www_releases_APP_NAME }}/"{{ $release }}"/storage;
mkdir -p {{ $var_www_APP_NAME }}/storage
ln -nfs {{ $var_www_APP_NAME }}/storage {{ $var_www_releases_APP_NAME }}/{{$release}}/storage;



# link vendor
#rm -r {{ $var_www_releases_APP_NAME }}/"{{ $release }}"/vendor;
mkdir -p {{ $var_www_APP_NAME }}/vendor

echo "{{ $var_www_APP_NAME }}/vendor <===> {{ $var_www_releases_APP_NAME }}/{{$release}}/vendor";
ln -nfs "{{ $var_www_APP_NAME }}/vendor" "{{ $var_www_releases_APP_NAME }}/{{$release}}/vendor";


# set permissions
cd {{ $var_www_releases_APP_NAME }}/{{$release}};
sudo chgrp -h www-data .env;
sudo chgrp -h www-data storage;
sudo chgrp -hR www-data {{ $var_www_APP_NAME }};
sudo chmod -R 775 {{ $var_www_APP_NAME }}/storage;


# make sure public storage is linked
mkdir -p {{ $var_www_APP_NAME }}/storage/app
echo "{{ $var_www_APP_NAME }}/storage/app/public <===> {{ $var_www_releases_APP_NAME }}/{{$release}}/public/storage";
ln -s {{ $var_www_APP_NAME }}/storage/app/public {{ $var_www_releases_APP_NAME }}/{{$release}}/public/storage


# reload the service
sudo service {{$php_version}}-fpm reload;


@endtask

@task('update_symlinks_current')

	echo "task: update_symlinks_current"

	cd {{ $var_www_APP_NAME }};



	# link .env
	ln -nfs {{ $var_www_APP_NAME }}/.env {{ $var_www_APP_NAME_app }}/.env;


	# link storage
	rm -r {{ $var_www_APP_NAME_app }}/storage;
	mkdir -p {{ $var_www_APP_NAME }}/storage
	ln -nfs {{ $var_www_APP_NAME }}/storage {{ $var_www_APP_NAME_app }}/storage;



	# link vendor
	mkdir -p {{ $var_www_APP_NAME }}/vendor

	echo "{{ $var_www_APP_NAME }}/vendor <===> {{ $var_www_APP_NAME_app }}/vendor";
	ln -nfs "{{ $var_www_APP_NAME }}/vendor" "{{ $var_www_APP_NAME_app }}/vendor";


	# set permissions
	cd {{ $var_www_APP_NAME_app }};
	sudo chgrp -h www-data .env;
	sudo chgrp -h www-data storage;
	sudo chgrp -hR www-data {{ $var_www_APP_NAME }};
	sudo chmod -R 775 {{ $var_www_APP_NAME }}/storage;


	# make sure public storage is linked
	mkdir -p {{ $var_www_APP_NAME }}/storage/app
	echo "{{ $var_www_APP_NAME }}/storage/app/public <===> {{ $var_www_APP_NAME_app }}/public/storage";
    ln -fs {{ $var_www_APP_NAME }}/storage/app/public {{ $var_www_APP_NAME_app }}/public/storage


	# reload the service
	sudo service {{$php_version}}-fpm reload;


@endtask

@task('clear_cache_current_release')
	echo "task: clear_cache_current_release"
	cd {{ $var_www_APP_NAME_app }}

	if [ ! -e {{$ENV_FILE}} ];then
	cp {{$ENV_EXAMPLE}} {{$ENV_FILE}}
	fi

	php artisan key:generate --force

	php artisan config:clear
	php artisan config:cache
	php artisan cache:clear
	php artisan clear-compiled --env=production;
@endtask

@task('clear_cache')
	echo "task: clear_cache"
	cd {{ $var_www_releases_APP_NAME }}/"{{ $release }}";
	{{--php artisan passport:keys --force--}}

	if [ ! -e {{$ENV_FILE}} ];then
		cp {{$ENV_EXAMPLE}} {{$ENV_FILE}}
	fi

	php artisan key:generate --force

	php artisan config:clear
	php artisan cache:clear
	php artisan config:cache
	php artisan clear-compiled --env=production;
@endtask

@task('enable_site')
	echo "task: enable_site"

	# link app directory with release

	echo "{{ $var_www_releases_APP_NAME }}/{{ $release }} <===> {{ $var_www_APP_NAME_app }}"

	ln -nfs {{ $var_www_releases_APP_NAME }}/"{{ $release }}" {{ $var_www_APP_NAME_app }};
@endtask












@task('commit', ['on' => 'localhost'])

echo "task: commit"

echo "committing";

@endtask





@task('rollback', ['on' => 'web'])
echo "task: rollback"

cd {{ $var_www_releases_APP_NAME }}

#find current release in release log
current=$(tail -1 release_log | head -1)

# find rollback release
prev=$(tail -2 release_log | head -1)

# remove most recent release from end of file
head -n -1 release_log > temp.txt ; mv temp.txt release_log

# new current release
current="{{ $var_www_releases_APP_NAME }}/$(tail -1 release_log | head -1)"

# replase link with the new current release
ln -nfs $current "{{ $var_www_APP_NAME_app }}"
sudo chgrp -hR www-data {{ $var_www_APP_NAME_app }}


cd {{ $var_www_APP_NAME_app }};
ln -nfs {{ $var_www_APP_NAME }}/.env "$current/.env"
sudo chgrp -h www-data .env;


sudo service php7.2-fpm reload;

@endtask
