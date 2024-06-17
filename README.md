# Short URL

## Dependencies

- Docker 4.31
- PHP 8.2
- Composer 2.7

## Start the project

```shell
docker compose up -d
```

To run the virtual machines it takes about 5 minutes the first time to build each virtual machine.

## Turning off machines

```shell
docker compose down
```

In case of problems we can delete the volumes or images of each machine from the docker.

## Web

To consult the website we have the local domain:

```shell
http://localhost:8080/api/v1/short-urls
```

Body

```shell
{
    "url": "https://tinyurl.com/ylx5uce"
}
```

Authorization

```shell
Authorization: Bearer []{}
```
