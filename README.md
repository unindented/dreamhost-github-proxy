# GitHub Proxy on DreamHost

Simple proxy for the GitHub API, written in PHP, to run on my DreamHost shared host.

## Install

You can install dependencies with [`composer`](https://getcomposer.org/):

```
$ composer install
```

## Test

You can test that everything is working by doing something like this:

```
curl -d " \
 { \
   \"query\": \"query { viewer { login }}\" \
 } \
" https://github.unindented.org/graphql
```

## Meta

- Code: `git clone https://github.com/unindented/dreamhost-github-proxy.git`
- Home: <https://unindented.org/>

## Contributors

Daniel Perez Alvarez ([unindented@gmail.com](mailto:unindented@gmail.com))

## License

Copyright (c) 2020 Daniel Perez Alvarez ([unindented.org](https://unindented.org/)). This is free software, and may be redistributed under the terms specified in the LICENSE file.
