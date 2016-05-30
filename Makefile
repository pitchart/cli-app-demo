

build: box sha1

box:
	php box.phar build

sha1:
	sha1sum build/cli-app-demo.phar > build/cli-app-demo.phar.version
