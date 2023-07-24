run_server:
    php -S localhost:8000 -t .\PHP

run_dev:
    npm run dev

build:
    npm install\
    npm run build

.PHONY: all
all: run_server run_dev