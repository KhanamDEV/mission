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
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#Feedback


<!-- START_7c633ef1d307c8e9e16af7afe6a74b5b -->
## api/v2/feedback

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/feedback" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"reiciendis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/feedback"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "reiciendis"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "title": "Mission 1",
            "detail": "Detail mission",
            "percent": 0.5,
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v2/feedback`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  optional  | nullable The team id of feedback.
    
<!-- END_7c633ef1d307c8e9e16af7afe6a74b5b -->

<!-- START_07895e75a66cca1763271035b4dcca46 -->
## api/v2/feedback/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/feedback/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"at"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/feedback/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "at"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "feedback": {
            "title": "Mission 1",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            },
            "hint_title": "Hint title",
            "hint_detail": "Hint detail"
        },
        "answers": [
            {
                "title": "What is your favorite fruit?",
                "list_answer": [
                    {
                        "user": "田中圭\/タナカケイ",
                        "type": 1,
                        "answer": [
                            "Ex1",
                            "Ex2"
                        ]
                    },
                    {
                        "user": "田中圭\/タナカケイ111",
                        "type": 3,
                        "answer": "abcd"
                    }
                ]
            }
        ]
    }
}
```

### HTTP Request
`GET api/v2/feedback/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of feedback
    
<!-- END_07895e75a66cca1763271035b4dcca46 -->

<!-- START_b6122cc9a0e0052c2205dbd7c1c86c24 -->
## api/v2/feedback

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/feedback" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"dicta"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/feedback"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "dicta"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "title": "Mission 1",
            "detail": "Detail mission",
            "percent": 0.5,
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/feedback`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  optional  | nullable The team id of feedback.
    
<!-- END_b6122cc9a0e0052c2205dbd7c1c86c24 -->

<!-- START_9125bca1cc58c75df6e942db0ee87b4c -->
## api/v2/feedback/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/feedback/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"veniam"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/feedback/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "veniam"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "feedback": {
            "title": "Mission 1",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            },
            "hint_title": "Hint title",
            "hint_detail": "Hint detail"
        },
        "answers": [
            {
                "title": "What is your favorite fruit?",
                "list_answer": [
                    {
                        "user": "田中圭\/タナカケイ",
                        "type": 1,
                        "answer": [
                            "Ex1",
                            "Ex2"
                        ]
                    },
                    {
                        "user": "田中圭\/タナカケイ111",
                        "type": 3,
                        "answer": "abcd"
                    }
                ]
            }
        ]
    }
}
```

### HTTP Request
`GET api/v1/feedback/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of feedback
    
<!-- END_9125bca1cc58c75df6e942db0ee87b4c -->

#ForgetPassword


<!-- START_751caced5a339485c42dbfc6c25f1461 -->
## api/v2/forget-password

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/forget-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"nisi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/forget-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "nisi"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (401):

```json
{
    "meta": {
        "status": 401,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v2/forget-password`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
    
<!-- END_751caced5a339485c42dbfc6c25f1461 -->

<!-- START_8c06e9cf423b374f408791fd37b3acbf -->
## api/v2/forget-password/confirm

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/forget-password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"dicta","token":"accusantium"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/forget-password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "dicta",
    "token": "accusantium"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v2/forget-password/confirm`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
        `token` | string |  required  | The token send to mail
    
<!-- END_8c06e9cf423b374f408791fd37b3acbf -->

<!-- START_10880b4b7c04fbe4df20190e34c91b38 -->
## api/v2/forget-password/change

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/forget-password/change" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"placeat","password":"accusantium","token":"omnis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/forget-password/change"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "placeat",
    "password": "accusantium",
    "token": "omnis"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/forget-password/change`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
        `password` | string |  required  | The new password of brand account
        `token` | string |  required  | The token send to mail
    
<!-- END_10880b4b7c04fbe4df20190e34c91b38 -->

<!-- START_33cf01c53ceed84f1e23700a1952d16f -->
## api/v2/forget-password

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/forget-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"totam"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/forget-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "totam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (401):

```json
{
    "meta": {
        "status": 401,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v1/forget-password`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
    
<!-- END_33cf01c53ceed84f1e23700a1952d16f -->

<!-- START_2fa4ceb7749a0b42c06f303c1a25e748 -->
## api/v2/forget-password/confirm

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/forget-password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"neque","token":"non"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/forget-password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "neque",
    "token": "non"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v1/forget-password/confirm`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
        `token` | string |  required  | The token send to mail
    
<!-- END_2fa4ceb7749a0b42c06f303c1a25e748 -->

<!-- START_8d92031b856746e6b565358dfbc15d67 -->
## api/v2/forget-password/change

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/forget-password/change" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"sint","password":"reprehenderit","token":"beatae"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/forget-password/change"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "sint",
    "password": "reprehenderit",
    "token": "beatae"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/forget-password/change`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
        `password` | string |  required  | The new password of brand account
        `token` | string |  required  | The token send to mail
    
<!-- END_8d92031b856746e6b565358dfbc15d67 -->

#Mission


<!-- START_0cc1cb2336518101b69d86075a53749a -->
## api/v2/mission

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/mission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v2/mission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "answered": [
            {
                "id": 1,
                "name": "Mission 1",
                "team_name": "Team 1",
                "delivery_order_date": "30-09-2021",
                "thumbnail": {
                    "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                    "height": 1356,
                    "width": 2048,
                    "ratio": 0.75
                },
                "is_target": true,
                "user_target": {
                    "name": "abc\/xyz",
                    "id": 1
                }
            }
        ],
        "not_answered": [
            {
                "id": 2,
                "name": "Mission 2",
                "team_name": "Team 2",
                "delivery_order_date": "2021-09-30",
                "thumbnail": {
                    "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                    "height": 1356,
                    "width": 2048,
                    "ratio": 0.75
                },
                "is_target": true,
                "user_target": {
                    "name": "abc\/xyz",
                    "id": 1
                }
            },
            {
                "id": 2,
                "name": "Mission 2",
                "team_name": "Team 2",
                "delivery_order_date": "2021-09-30",
                "thumbnail": {
                    "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                    "height": 1356,
                    "width": 2048,
                    "ratio": 0.75
                },
                "is_target": false,
                "user_target": {}
            }
        ]
    }
}
```

### HTTP Request
`GET api/v2/mission`


<!-- END_0cc1cb2336518101b69d86075a53749a -->

<!-- START_2d398490f2c0e1e01995876d74e5519a -->
## api/v2/mission/question
type: 1 =&gt; checkbox, 2 =&gt; select, 3 =&gt; text, 4 =&gt; image

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/mission/question" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"voluptatem"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/mission/question"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "voluptatem"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "mission": {
            "id": 1,
            "name": "Mission 1",
            "is_target": "true",
            "user_target": {
                "id": 1,
                "name": "abc\/xyz"
            },
            "time_required": "355 days"
        },
        "questions": [
            {
                "id": 1,
                "title": "What your name ?",
                "type": 1,
                "choice": [
                    "Nam",
                    "Cuong"
                ]
            }
        ]
    }
}
```

### HTTP Request
`GET api/v2/mission/question`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The mission id contain question
    
<!-- END_2d398490f2c0e1e01995876d74e5519a -->

<!-- START_c332d1c6f83c5caabbd1fd0522e365fc -->
## api/v2/mission/question

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/mission/question" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"answers":"ut","mission_id":"nam","is_anonymous":false}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/mission/question"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "answers": "ut",
    "mission_id": "nam",
    "is_anonymous": false
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v2/mission/question`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `answers` | json |  required  | The json array contain answer ( [{"id":1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
        `mission_id` | numeric |  required  | The id mission of question
        `is_anonymous` | boolean |  required  | The type person answer
    
<!-- END_c332d1c6f83c5caabbd1fd0522e365fc -->

<!-- START_27a6d859370099be48c05ac1e514ebaf -->
## api/v2/mission/question-answered

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/mission/question-answered" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"mission_id":"alias"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/mission/question-answered"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mission_id": "alias"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "mission": {
            "id": 1,
            "name": "Mission 1",
            "delivery_order_date": "2021-06-28",
            "time_required": "355 days"
        },
        "questions": [
            {
                "id": 1,
                "title": "What your name ?",
                "type": "1",
                "choice": [
                    "Nam",
                    "Cuong"
                ]
            },
            {
                "id": 2,
                "title": "How old are u ?",
                "type": "3",
                "choice": "21"
            }
        ]
    }
}
```

### HTTP Request
`GET api/v2/mission/question-answered`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `mission_id` | numeric |  required  | The mission base id contain question
    
<!-- END_27a6d859370099be48c05ac1e514ebaf -->

<!-- START_16129ab48e9ab16aeb010ef8605b0759 -->
## api/v2/mission/edit-question-answered

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/mission/edit-question-answered" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"answers":"non","mission_id":"quasi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/mission/edit-question-answered"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "answers": "non",
    "mission_id": "quasi"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/mission/edit-question-answered`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `answers` | json |  required  | The json array contain answer ( [{"id":1,"question_id": 1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
        `mission_id` | The |  optional  | id of mission contain answers
    
<!-- END_16129ab48e9ab16aeb010ef8605b0759 -->

<!-- START_c20c612669bb7d643538ad3107f4fff9 -->
## api/v2/mission

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/mission" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/mission"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "answered": [
            {
                "id": 1,
                "name": "Mission 1",
                "team_name": "Team 1",
                "delivery_order_date": "30-09-2021",
                "thumbnail": {
                    "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                    "height": 1356,
                    "width": 2048,
                    "ratio": 0.75
                },
                "is_target": true,
                "user_target": {
                    "name": "abc\/xyz",
                    "id": 1
                }
            }
        ],
        "not_answered": [
            {
                "id": 2,
                "name": "Mission 2",
                "team_name": "Team 2",
                "delivery_order_date": "2021-09-30",
                "thumbnail": {
                    "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                    "height": 1356,
                    "width": 2048,
                    "ratio": 0.75
                },
                "is_target": true,
                "user_target": {
                    "name": "abc\/xyz",
                    "id": 1
                }
            },
            {
                "id": 2,
                "name": "Mission 2",
                "team_name": "Team 2",
                "delivery_order_date": "2021-09-30",
                "thumbnail": {
                    "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                    "height": 1356,
                    "width": 2048,
                    "ratio": 0.75
                },
                "is_target": false,
                "user_target": {}
            }
        ]
    }
}
```

### HTTP Request
`GET api/v1/mission`


<!-- END_c20c612669bb7d643538ad3107f4fff9 -->

<!-- START_cd023ce0dbde02e12a6207e8d5db4ad3 -->
## api/v2/mission/question
type: 1 =&gt; checkbox, 2 =&gt; select, 3 =&gt; text, 4 =&gt; image

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/mission/question" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"dolorum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/mission/question"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "dolorum"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "mission": {
            "id": 1,
            "name": "Mission 1",
            "is_target": "true",
            "user_target": {
                "id": 1,
                "name": "abc\/xyz"
            },
            "time_required": "355 days"
        },
        "questions": [
            {
                "id": 1,
                "title": "What your name ?",
                "type": 1,
                "choice": [
                    "Nam",
                    "Cuong"
                ]
            }
        ]
    }
}
```

### HTTP Request
`GET api/v1/mission/question`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The mission id contain question
    
<!-- END_cd023ce0dbde02e12a6207e8d5db4ad3 -->

<!-- START_ca17ae720f6a0ef727174ad1099ebcc9 -->
## api/v2/mission/question

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/mission/question" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"answers":"eos","mission_id":"libero","is_anonymous":true}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/mission/question"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "answers": "eos",
    "mission_id": "libero",
    "is_anonymous": true
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v1/mission/question`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `answers` | json |  required  | The json array contain answer ( [{"id":1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
        `mission_id` | numeric |  required  | The id mission of question
        `is_anonymous` | boolean |  required  | The type person answer
    
<!-- END_ca17ae720f6a0ef727174ad1099ebcc9 -->

<!-- START_b1269ec9fe7da0d1ae1647551d47d2f4 -->
## api/v2/mission/question-answered

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/mission/question-answered" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"mission_id":"neque"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/mission/question-answered"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mission_id": "neque"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "mission": {
            "id": 1,
            "name": "Mission 1",
            "delivery_order_date": "2021-06-28",
            "time_required": "355 days"
        },
        "questions": [
            {
                "id": 1,
                "title": "What your name ?",
                "type": "1",
                "choice": [
                    "Nam",
                    "Cuong"
                ]
            },
            {
                "id": 2,
                "title": "How old are u ?",
                "type": "3",
                "choice": "21"
            }
        ]
    }
}
```

### HTTP Request
`GET api/v1/mission/question-answered`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `mission_id` | numeric |  required  | The mission base id contain question
    
<!-- END_b1269ec9fe7da0d1ae1647551d47d2f4 -->

<!-- START_ab5af79bfed1f7b860cfa61d91ad1aef -->
## api/v2/mission/edit-question-answered

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/mission/edit-question-answered" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"answers":"ipsum","mission_id":"voluptatem"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/mission/edit-question-answered"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "answers": "ipsum",
    "mission_id": "voluptatem"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/mission/edit-question-answered`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `answers` | json |  required  | The json array contain answer ( [{"id":1,"question_id": 1,"title":"What is your favorite fruit?","type": 1,"choice":["A","B","C","D"],"answer":["A","B"]}] )
        `mission_id` | The |  optional  | id of mission contain answers
    
<!-- END_ab5af79bfed1f7b860cfa61d91ad1aef -->

#Notification


<!-- START_bd87b9440859e63ed41f265e1f508fe8 -->
## api/v2/notification

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"type":"qui"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "type": "qui"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "brand": [
            {
                "id": 1,
                "title": "Notify 1",
                "is_seen": "false",
                "created_at": "2021\/11\/23"
            }
        ],
        "system": [
            {
                "id": 2,
                "title": "Notify 2",
                "is_seen": "true",
                "created_at": "2021\/09\/30"
            }
        ]
    }
}
```

### HTTP Request
`GET api/v2/notification`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `type` | string |  optional  | not required Ex: system, brand
    
<!-- END_bd87b9440859e63ed41f265e1f508fe8 -->

<!-- START_667bf0189c8c74fc8bb13a0bf13bd7e4 -->
## api/v2/notification/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/notification/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"ut","type":"sit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/notification/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "ut",
    "type": "sit"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "title": "Title",
        "description": "Description",
        "url": "url"
    }
}
```

### HTTP Request
`GET api/v2/notification/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  optional  | The id of notification
        `type` | string |  optional  | Type of notification Ex: brand, system
    
<!-- END_667bf0189c8c74fc8bb13a0bf13bd7e4 -->

#Program


<!-- START_618b6452cb0ab08b62199937374818b9 -->
## api/v2/program

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/program" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v2/program"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name": "Program 1",
            "detail": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure molestiae voluptate at ab quae, maiores assumenda sapiente accusamus repellendus ea sint. Corporis laborum deleniti dolor doloribus a molestias esse nostrum?",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v2/program`


<!-- END_618b6452cb0ab08b62199937374818b9 -->

<!-- START_ea3c194b1f147aecda8e66dd333fae18 -->
## api/v2/program/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/program/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"vel"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/program/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "vel"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "name": "Program 1",
        "detail": "Detail program 1",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v2/program/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of program
    
<!-- END_ea3c194b1f147aecda8e66dd333fae18 -->

<!-- START_1d02212382e43da692347921c7e96d1b -->
## api/v2/program

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/program" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/program"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name": "Program 1",
            "detail": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure molestiae voluptate at ab quae, maiores assumenda sapiente accusamus repellendus ea sint. Corporis laborum deleniti dolor doloribus a molestias esse nostrum?",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/program`


<!-- END_1d02212382e43da692347921c7e96d1b -->

<!-- START_786763605597493f274ff59454cc9217 -->
## api/v2/program/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/program/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"vel"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/program/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "vel"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "name": "Program 1",
        "detail": "Detail program 1",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v1/program/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of program
    
<!-- END_786763605597493f274ff59454cc9217 -->

#SignIn


<!-- START_4226b34141260b47a8d49ec906d48e6b -->
## api/v2/sign-in

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/sign-in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"doloribus","password":"reprehenderit"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/sign-in"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "doloribus",
    "password": "reprehenderit"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "email": "khanam@techasia.biz",
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvc2lnbi1pbiIsImlhdCI6MTYyMTU2OTA2NiwiZXhwIjoxNjIxNTcyNjY2LCJuYmYiOjE2MjE1NjkwNjYsImp0aSI6IjEyZEVkdGdFTnUweHZnd24iLCJzdWIiOjEsInBydiI6IjIzOWNmMmI3ZDU4MjI2ZTgyMWMxMjQxMDAyMzBkZWU5ZmE4ZWQ2NzkifQ.b0R2TRZxGyBq9JUMCjgt-fjFieNEd5Ywo1jD9u_WPZA"
    }
}
```
> Example response (401):

```json
{
    "meta": {
        "status": 401,
        "message": "メールアドレスとパスワードが不一致"
    },
    "response": null
}
```

### HTTP Request
`POST api/v2/sign-in`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
        `password` | string |  required  | The password of brand account
    
<!-- END_4226b34141260b47a8d49ec906d48e6b -->

<!-- START_5236fef7db715959ef31d7f163ae1661 -->
## api/v2/sign-in

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/sign-in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"ea","password":"doloremque"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/sign-in"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "ea",
    "password": "doloremque"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "email": "khanam@techasia.biz",
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBpXC92MVwvc2lnbi1pbiIsImlhdCI6MTYyMTU2OTA2NiwiZXhwIjoxNjIxNTcyNjY2LCJuYmYiOjE2MjE1NjkwNjYsImp0aSI6IjEyZEVkdGdFTnUweHZnd24iLCJzdWIiOjEsInBydiI6IjIzOWNmMmI3ZDU4MjI2ZTgyMWMxMjQxMDAyMzBkZWU5ZmE4ZWQ2NzkifQ.b0R2TRZxGyBq9JUMCjgt-fjFieNEd5Ywo1jD9u_WPZA"
    }
}
```
> Example response (401):

```json
{
    "meta": {
        "status": 401,
        "message": "メールアドレスとパスワードが不一致"
    },
    "response": null
}
```

### HTTP Request
`POST api/v1/sign-in`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The email of brand account
        `password` | string |  required  | The password of brand account
    
<!-- END_5236fef7db715959ef31d7f163ae1661 -->

#SinglePage


<!-- START_b80686484609ccb6b5d154e8bc5bbfd3 -->
## api/v2/single-page

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/single-page/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"page":"eligendi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/single-page/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "page": "eligendi"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "response": "html content"
}
```
> Example response (500):

```json
{
    "response": ""
}
```

### HTTP Request
`GET api/v2/single-page/{page}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `page` | string |  optional  | The page get content Ex: api/v2/single-page/company, api/v2/single-page/term_privacy
    
<!-- END_b80686484609ccb6b5d154e8bc5bbfd3 -->

<!-- START_bc484543c614bc2e02cadcf0a3705b87 -->
## api/v2/single-page

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/single-page/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"page":"autem"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/single-page/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "page": "autem"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "response": "html content"
}
```
> Example response (500):

```json
{
    "response": ""
}
```

### HTTP Request
`GET api/v1/single-page/{page}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `page` | string |  optional  | The page get content Ex: api/v2/single-page/company, api/v2/single-page/term_privacy
    
<!-- END_bc484543c614bc2e02cadcf0a3705b87 -->

#Team


<!-- START_dca154645326bd4fa9f86109221daf76 -->
## api/v2/team

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/team" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v2/team"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name": "Team 1",
            "detail": "Detail team 1",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v2/team`


<!-- END_dca154645326bd4fa9f86109221daf76 -->

<!-- START_471db1927b3997bb190d9250749ffb35 -->
## api/v2/team/create

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/team/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"data":"dignissimos"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "data": "dignissimos"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v2/team/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `data` | json |  required  | The data create team ({"team":{"thumbnail_url":"url image","name":"Team 1"},"users":[{"id":1,"is_leader":true}],"program_id":1})
    
<!-- END_471db1927b3997bb190d9250749ffb35 -->

<!-- START_d5b783025be05b3392a9f04b34cc429f -->
## api/v2/team/edit

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/team/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"necessitatibus","name":"esse","thumbnail_url":"quis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "necessitatibus",
    "name": "esse",
    "thumbnail_url": "quis"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/team/edit`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
        `name` | string |  required  | The name of team
        `thumbnail_url` | string |  optional  | The url image thumbnail team
    
<!-- END_d5b783025be05b3392a9f04b34cc429f -->

<!-- START_97b6173e9c1f5db853348326b54eee29 -->
## api/v2/team/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/team/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"aut"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "aut"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "name": "Team 1",
        "program_id": 1,
        "program_name": "Program 1",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v2/team/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of team
    
<!-- END_97b6173e9c1f5db853348326b54eee29 -->

<!-- START_aa8b52dddd0ef7226c23ff0ad8fb0671 -->
## api/v2/team/edit-program

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/team/edit-program" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"doloribus","program_id":"inventore"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/edit-program"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "doloribus",
    "program_id": "inventore"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/team/edit-program`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
        `program_id` | numeric |  required  | The program id
    
<!-- END_aa8b52dddd0ef7226c23ff0ad8fb0671 -->

<!-- START_b5d2260c872ea389390d8e5bb73a5cb5 -->
## api/v2/team/edit-member

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/team/edit-member" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"et","members":"inventore"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/edit-member"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "et",
    "members": "inventore"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/team/edit-member`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
        `members` | json |  required  | The data user ( [{"id":1,"is_leader":true}] )
    
<!-- END_b5d2260c872ea389390d8e5bb73a5cb5 -->

<!-- START_fd7d6285d10fadd10fd6e0d37b5a3295 -->
## api/v2/team/member

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/team/member" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"non","type":"quibusdam"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/member"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "non",
    "type": "quibusdam"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name": "KhaNam\/KhaNam",
            "name_sei": "Kha",
            "name_mei": "Nam",
            "is_team_member": 1,
            "is_leader": 1,
            "position": "member",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v2/team/member`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of team
        `type` | string |  optional  | The type get member (get for show, get for edit) Ex:  edit
    
<!-- END_fd7d6285d10fadd10fd6e0d37b5a3295 -->

<!-- START_d43eab55ba6c4af204ccb8f6ea9f629a -->
## api/v2/team/member/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/team/member/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"dignissimos"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/member/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "dignissimos"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "name_sei": "Kha",
        "name_mei": "Nam",
        "name_sei_kana": "Kha",
        "name_mei_kana": "Nam",
        "name": "Kha Nam \/ Kha Nam",
        "department": "department",
        "detail": "This is detail",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v2/team/member/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of member
    
<!-- END_d43eab55ba6c4af204ccb8f6ea9f629a -->

<!-- START_95cd619e97f42df83a06c8e902906fba -->
## api/v2/team/delete

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v2/team/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"cum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/team/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "cum"
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`DELETE api/v2/team/delete`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
    
<!-- END_95cd619e97f42df83a06c8e902906fba -->

<!-- START_14527ef13d395bdec2bb4e378ccd907e -->
## api/v2/team

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/team" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/team"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name": "Team 1",
            "detail": "Detail team 1",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/team`


<!-- END_14527ef13d395bdec2bb4e378ccd907e -->

<!-- START_679beab4cc6b84e683fbb7acd41ac705 -->
## api/v2/team/create

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/team/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"data":"iure"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "data": "iure"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`POST api/v1/team/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `data` | json |  required  | The data create team ({"team":{"thumbnail_url":"url image","name":"Team 1"},"users":[{"id":1,"is_leader":true}],"program_id":1})
    
<!-- END_679beab4cc6b84e683fbb7acd41ac705 -->

<!-- START_69007c7c06781f751ee8e1e234145441 -->
## api/v2/team/edit

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/team/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"laboriosam","name":"rerum","thumbnail_url":"excepturi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "laboriosam",
    "name": "rerum",
    "thumbnail_url": "excepturi"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/team/edit`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
        `name` | string |  required  | The name of team
        `thumbnail_url` | string |  optional  | The url image thumbnail team
    
<!-- END_69007c7c06781f751ee8e1e234145441 -->

<!-- START_99d813c94819540cf37da1f2a713b581 -->
## api/v2/team/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/team/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"error"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "error"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "name": "Team 1",
        "program_id": 1,
        "program_name": "Program 1",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v1/team/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of team
    
<!-- END_99d813c94819540cf37da1f2a713b581 -->

<!-- START_9998b9b6c617ff1cb033fb09e9b8856c -->
## api/v2/team/edit-program

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/team/edit-program" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"error","program_id":"sunt"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/edit-program"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "error",
    "program_id": "sunt"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/team/edit-program`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
        `program_id` | numeric |  required  | The program id
    
<!-- END_9998b9b6c617ff1cb033fb09e9b8856c -->

<!-- START_5e8eef171d6caf3140fe83a36341974d -->
## api/v2/team/edit-member

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/team/edit-member" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"aut","members":"modi"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/edit-member"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "aut",
    "members": "modi"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/team/edit-member`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
        `members` | json |  required  | The data user ( [{"id":1,"is_leader":true}] )
    
<!-- END_5e8eef171d6caf3140fe83a36341974d -->

<!-- START_6c4fd0a52bca635df81b464ca1a353e7 -->
## api/v2/team/member

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/team/member" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"minima","type":"cumque"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/member"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "minima",
    "type": "cumque"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name": "KhaNam\/KhaNam",
            "name_sei": "Kha",
            "name_mei": "Nam",
            "is_team_member": 1,
            "is_leader": 1,
            "position": "member",
            "thumbnail": {
                "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
                "height": 1536,
                "width": 2048,
                "ratio": 0.75
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/team/member`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of team
        `type` | string |  optional  | The type get member (get for show, get for edit) Ex:  edit
    
<!-- END_6c4fd0a52bca635df81b464ca1a353e7 -->

<!-- START_8790f053023d151c9821d839a28463d9 -->
## api/v2/team/member/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/team/member/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":"magni"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/member/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": "magni"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "id": 1,
        "name_sei": "Kha",
        "name_mei": "Nam",
        "name_sei_kana": "Kha",
        "name_mei_kana": "Nam",
        "name": "Kha Nam \/ Kha Nam",
        "department": "department",
        "detail": "This is detail",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v1/team/member/detail`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | numeric |  required  | The id of member
    
<!-- END_8790f053023d151c9821d839a28463d9 -->

<!-- START_4580fb9c7c2003b3422ca4fd88164e03 -->
## api/v2/team/delete

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/team/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"team_id":"maiores"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/team/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "team_id": "maiores"
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`DELETE api/v1/team/delete`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `team_id` | numeric |  required  | The team id
    
<!-- END_4580fb9c7c2003b3422ca4fd88164e03 -->

#Upload


<!-- START_63ba354dc0b4d321aaef310f5a997f98 -->
## api/v2/upload-image

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/upload-image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"image":"et","type":"laborum"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/upload-image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "image": "et",
    "type": "laborum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "url": "url image"
    }
}
```

### HTTP Request
`POST api/v2/upload-image`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `image` | base64 |  required  | The image
        `type` | string |  required  | The type of image Ex: question, team,...
    
<!-- END_63ba354dc0b4d321aaef310f5a997f98 -->

<!-- START_79fd5ccda25e3eaf93d683c938e67b4c -->
## api/v2/upload-image

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/upload-image" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"image":"eligendi","type":"est"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/upload-image"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "image": "eligendi",
    "type": "est"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "url": "url image"
    }
}
```

### HTTP Request
`POST api/v1/upload-image`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `image` | base64 |  required  | The image
        `type` | string |  required  | The type of image Ex: question, team,...
    
<!-- END_79fd5ccda25e3eaf93d683c938e67b4c -->

#User


<!-- START_93329f84924f6899bebbb66a5b88189c -->
## api/v2/user

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v2/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name_sei": "name sei",
            "name_mei": "name mei",
            "name_sei_kana": "name sei kana",
            "name_mei_kana": "name mei kana",
            "thumbnail": {
                "url": "url image",
                "height": 1365,
                "width": 720,
                "ratio": 2
            }
        }
    ]
}
```

### HTTP Request
`GET api/v2/user`


<!-- END_93329f84924f6899bebbb66a5b88189c -->

<!-- START_235e9ec5d9877b9fea1ffdd582a4bcda -->
## api/v2/user/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/user/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "name_sei": "Kha",
        "name_mei": "Nam",
        "name_sei_kana": "Kha kana",
        "name_mei_kana": "Nam kana",
        "detail": "Detail",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v2/user/detail`


<!-- END_235e9ec5d9877b9fea1ffdd582a4bcda -->

<!-- START_f63f83395533a27e39726015b2c23702 -->
## api/v2/user/edit

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/user/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name_sei":"qui","name_mei":"iusto","name_sei_kana":"recusandae","name_mei_kana":"nostrum","detail":"quisquam","thumbnail_url":"numquam"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name_sei": "qui",
    "name_mei": "iusto",
    "name_sei_kana": "recusandae",
    "name_mei_kana": "nostrum",
    "detail": "quisquam",
    "thumbnail_url": "numquam"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/user/edit`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name_sei` | string |  optional  | 
        `name_mei` | string |  optional  | 
        `name_sei_kana` | string |  optional  | 
        `name_mei_kana` | string |  optional  | 
        `detail` | string |  optional  | 
        `thumbnail_url` | string |  optional  | 
    
<!-- END_f63f83395533a27e39726015b2c23702 -->

<!-- START_1effbe37ab8c461980b878ac31f0df98 -->
## api/v2/user/upload-avatar

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/user/upload-avatar" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"thumbnail_url":"incidunt"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/upload-avatar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "thumbnail_url": "incidunt"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/user/upload-avatar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `thumbnail_url` | string |  required  | The image of user
    
<!-- END_1effbe37ab8c461980b878ac31f0df98 -->

<!-- START_350a444bdf96e44c241784b3502c4521 -->
## api/v2/user/update-push-notification-token

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/user/update-push-notification-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"numquam","device":"nihil"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/update-push-notification-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "numquam",
    "device": "nihil"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/user/update-push-notification-token`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | 
        `device` | string |  required  | Ex: android, iOS
    
<!-- END_350a444bdf96e44c241784b3502c4521 -->

<!-- START_592244edf7b11cc6e1cde9bb4a52a059 -->
## api/v2/user/remove-push-notification-token

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v2/user/remove-push-notification-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"voluptas"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/remove-push-notification-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "voluptas"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v2/user/remove-push-notification-token`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | 
    
<!-- END_592244edf7b11cc6e1cde9bb4a52a059 -->

<!-- START_3a5b3dbc04ab9e850325be385269d956 -->
## api/v2/user/send-notification

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/user/send-notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user_id":10,"type":"nobis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/send-notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": 10,
    "type": "nobis"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```

### HTTP Request
`POST api/v2/user/send-notification`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user_id` | integer |  optional  | id of user receive notify
        `type` | string |  optional  | Ex: beer
    
<!-- END_3a5b3dbc04ab9e850325be385269d956 -->

<!-- START_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->
## api/v2/user

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": [
        {
            "id": 1,
            "name_sei": "name sei",
            "name_mei": "name mei",
            "name_sei_kana": "name sei kana",
            "name_mei_kana": "name mei kana",
            "thumbnail": {
                "url": "url image",
                "height": 1365,
                "width": 720,
                "ratio": 2
            }
        }
    ]
}
```

### HTTP Request
`GET api/v1/user`


<!-- END_d7f5c16f3f30bc08c462dbfe4b62c6b9 -->

<!-- START_eef24974558332f7a9bb08bb91086538 -->
## api/v2/user/detail

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/user/detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "name_sei": "Kha",
        "name_mei": "Nam",
        "name_sei_kana": "Kha kana",
        "name_mei_kana": "Nam kana",
        "detail": "Detail",
        "thumbnail": {
            "url": "https:\/\/missionimg.s3-ap-northeast-1.amazonaws.com\/321.jpg",
            "height": 1536,
            "width": 2048,
            "ratio": 0.75
        }
    }
}
```

### HTTP Request
`GET api/v1/user/detail`


<!-- END_eef24974558332f7a9bb08bb91086538 -->

<!-- START_51a5fc9c96c4121f51597000855ddb67 -->
## api/v2/user/edit

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/user/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name_sei":"non","name_mei":"veniam","name_sei_kana":"temporibus","name_mei_kana":"ut","detail":"veniam","thumbnail_url":"occaecati"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name_sei": "non",
    "name_mei": "veniam",
    "name_sei_kana": "temporibus",
    "name_mei_kana": "ut",
    "detail": "veniam",
    "thumbnail_url": "occaecati"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/user/edit`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name_sei` | string |  optional  | 
        `name_mei` | string |  optional  | 
        `name_sei_kana` | string |  optional  | 
        `name_mei_kana` | string |  optional  | 
        `detail` | string |  optional  | 
        `thumbnail_url` | string |  optional  | 
    
<!-- END_51a5fc9c96c4121f51597000855ddb67 -->

<!-- START_fb72250c6a514f4ece9b2253f4d9a58d -->
## api/v2/user/upload-avatar

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/user/upload-avatar" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"thumbnail_url":"quo"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/upload-avatar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "thumbnail_url": "quo"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存に失敗しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/user/upload-avatar`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `thumbnail_url` | string |  required  | The image of user
    
<!-- END_fb72250c6a514f4ece9b2253f4d9a58d -->

<!-- START_16f7f24a3f0fec3e8c776ca405b2e6e9 -->
## api/v2/user/update-push-notification-token

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/user/update-push-notification-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"voluptatum","device":"sed"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/update-push-notification-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "voluptatum",
    "device": "sed"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/user/update-push-notification-token`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | 
        `device` | string |  required  | Ex: android, iOS
    
<!-- END_16f7f24a3f0fec3e8c776ca405b2e6e9 -->

<!-- START_2c06120edeafb3d69b963115480f8611 -->
## api/v2/user/remove-push-notification-token

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/user/remove-push-notification-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"exercitationem"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/remove-push-notification-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "exercitationem"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```
> Example response (500):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": {
        "status": false
    }
}
```

### HTTP Request
`PUT api/v1/user/remove-push-notification-token`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | 
    
<!-- END_2c06120edeafb3d69b963115480f8611 -->

<!-- START_a84e8f40e16463f891d8ce270ba2b4ed -->
## api/v2/user/send-notification

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/send-notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"user_id":11,"type":"amet"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/send-notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": 11,
    "type": "amet"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 200,
        "message": "保存しました"
    },
    "response": {
        "status": true
    }
}
```

### HTTP Request
`POST api/v1/user/send-notification`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `user_id` | integer |  optional  | id of user receive notify
        `type` | string |  optional  | Ex: beer
    
<!-- END_a84e8f40e16463f891d8ce270ba2b4ed -->

#general


<!-- START_093ec9a3d0ef339a48fc652778b0d280 -->
## api/v2/user/get-push-token
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v2/user/get-push-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/get-push-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": []
}
```

### HTTP Request
`GET api/v2/user/get-push-token`


<!-- END_093ec9a3d0ef339a48fc652778b0d280 -->

<!-- START_6fe4e22680e0cfbe95a384ea1d21f918 -->
## api/v2/user/send-notification-daily
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v2/user/send-notification-daily" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v2/user/send-notification-daily"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v2/user/send-notification-daily`


<!-- END_6fe4e22680e0cfbe95a384ea1d21f918 -->

<!-- START_9af809b0285669724fe8d3c790c6ae86 -->
## api/v1/user/get-push-token
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/user/get-push-token" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/get-push-token"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "meta": {
        "status": 500,
        "message": "内部サーバーエラー"
    },
    "response": []
}
```

### HTTP Request
`GET api/v1/user/get-push-token`


<!-- END_9af809b0285669724fe8d3c790c6ae86 -->

<!-- START_5e13d7849164ac34b0f428c52a184a0d -->
## api/v1/user/send-notification-daily
> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/send-notification-daily" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/send-notification-daily"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/v1/user/send-notification-daily`


<!-- END_5e13d7849164ac34b0f428c52a184a0d -->


