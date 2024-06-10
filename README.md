# Hexagone Projet Web: GitHub Reviews

```shell
docker compose up
```

| Service    | URL                           |
|------------|-------------------------------|
| Apache     | http://127.0.0.1:8000         |
| MySQL      | mysql://127.0.0.1:6033/app_db |
| phpMyAdmin | http://127.0.0.1:8081         |

## Azure Deployment (NOT WORKING YET)

### Azure CLI

```shell
az login
az acr login --name hexaprojetweb
```

### Azure Resource Group

```shell
az group create --location westeurope --name HexagoneProjetWeb
```

### Azure Container Registry

```shell
az acr create --resource-group HexagoneProjetWeb --name hexaprojetweb --sku Basic
```

### Build Production Image

```shell
docker build --file prod.Dockerfile --tag hexagone-web-projet --load .
```

### Push Production Image

```shell
docker tag hexagone-web-projet hexaprojetweb.azurecr.io/hexagone-web-projet
docker push hexaprojetweb.azurecr.io/hexagone-web-projet:latest
```

### Azure App Service

```shell
az appservice plan create --name hexagone-projet-web --resource-group HexagoneProjetWeb --sku S1 --is-linux
az webapp create --resource-group HexagoneProjetWeb --plan hexagone-projet-web --name hexagone-projet-web --multicontainer-config-type compose --multicontainer-config-file compose.azure.yml
```

### Delete Azure Resources

```shell
az group delete --name HexagoneProjetWeb
```
