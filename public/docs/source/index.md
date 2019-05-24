---
title: API Reference

language_tabs:
- bash

- javascript


includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.

<!-- END_INFO -->

#general
<!-- START_f42e87598c8353944d88aa8de3b294a1 -->
## api/vendors
> Example request:

```bash
curl -X GET -G "https://api.frc.org/api/vendors" 
```

```javascript
const url = new URL("https://api.frc.org/api/vendors");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):


```json
[
    {
        "id": 1,
        "name": "Cornerstone Payments",
        "website": null,
        "created_at": "2019-05-21 20:49:53",
        "updated_at": "2019-05-21 20:49:53",
        "apis": [
            {
                "id": 1,
                "vendor_id": 1,
                "client_id": "test_3kdyN4LepSQxKYFx2uYa",
                "client_secret": "test_PR5OMgJ498wNRGrv4tLgwFHub",
                "base_url": "https:\/\/api.cornerstone.cc\/v1",
                "auth_type_id": 1,
                "created_at": "2019-05-21 20:49:53",
                "updated_at": "2019-05-21 20:49:53"
            }
        ]
    }
]
```

### HTTP Request
`GET api/vendors`


<!-- END_f42e87598c8353944d88aa8de3b294a1 -->

<!-- START_bd154e283685d3f5bf363f9e85ab040e -->
## api/vendors/create
> Example request:

```bash
curl -X GET -G "https://api.frc.org/api/vendors/create" 
```

```javascript
const url = new URL("https://api.frc.org/api/vendors/create");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):


```json
null
```

### HTTP Request
`GET api/vendors/create`


<!-- END_bd154e283685d3f5bf363f9e85ab040e -->

<!-- START_a43dce37a6ffdfa41a36e07bdf46e8ba -->
## api/vendors/{vendor}/api-calls
> Example request:

```bash
curl -X GET -G "https://api.frc.org/api/vendors/1/api-calls" 
```

```javascript
const url = new URL("https://api.frc.org/api/vendors/1/api-calls");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):


```json
[
    {}
]
```

### HTTP Request
`GET api/vendors/{vendor}/api-calls`


<!-- END_a43dce37a6ffdfa41a36e07bdf46e8ba -->

<!-- START_12d1273fe28bd4251c83116271280eef -->
## api/vendors/{vendor}/call-api/{api}
> Example request:

```bash
curl -X GET -G "https://api.frc.org/api/vendors/1/call-api/1" 
```

```javascript
const url = new URL("https://api.frc.org/api/vendors/1/call-api/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):


```json
[
    {}
]
```

### HTTP Request
`GET api/vendors/{vendor}/call-api/{api}`


<!-- END_12d1273fe28bd4251c83116271280eef -->

<!-- START_c19b75ecacca0bf954a83fe91372dd35 -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET -G "https://api.frc.org/api/api-calls" 
```

```javascript
const url = new URL("https://api.frc.org/api/api-calls");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):


```json
[
    {
        "id": 1,
        "api_endpoint_id": "1",
        "finished": "0",
        "response": "{\n\t\"cornerstone\": \"Y'ello\",\n\t\"version\": \"1.6\",\n\t\"build\": \"8816\",\n\t\"documentation\": \"https:\/\/github.com\/cpscc\/wiki\/blob\/master\/official-cornerstone-api.md\"\n}\n",
        "created_at": "2019-05-21 20:49:55",
        "updated_at": "2019-05-21 20:49:55"
    }
]
```

### HTTP Request
`GET api/api-calls`


<!-- END_c19b75ecacca0bf954a83fe91372dd35 -->

<!-- START_875fc3274b3f15d40fdf5a3b6b3eda23 -->
## test_api_call
> Example request:

```bash
curl -X GET -G "https://api.frc.org/test_api_call" 
```

```javascript
const url = new URL("https://api.frc.org/test_api_call");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):


```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET test_api_call`


<!-- END_875fc3274b3f15d40fdf5a3b6b3eda23 -->


