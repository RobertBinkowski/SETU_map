run_server:
	php -S localhost:8000 -t .\PHP

run_dev:
	npm run dev

build:
	npm install;\
	npm run build

.PHONY: all
run: run_dev run_server
