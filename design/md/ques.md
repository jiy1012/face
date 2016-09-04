http://127.0.0.1/face/ajax/user/ques/add?title=title&content=1231231&catid=12
{
"errno": 0,
"errmsg": "OK",
"data": 1
}


http://127.0.0.1/face/ajax/user/ques/edit?title=title4&content=1231231&catid=12&id=4
{
"errno": 0,
"errmsg": "OK",
"data": []
}

http://127.0.0.1/face/ajax/user/ques/del?id=4

{
"errno": 0,
"errmsg": "OK",
"data": []
}
curl 'http://127.0.0.1/face/ajax/user/ques/qlist?page_index=1'|jq
{
  "errno": 0,
  "errmsg": "ok",
  "data": {
    "list": [
      {
        "id": "5",
        "catid": "12",
        "title": "title",
        "content": "1231231",
        "createtime": "1473002014",
        "updatetime": "0",
        "like": "0",
        "dislike": "0",
        "author": "0",
        "delete": "0"
      }
    ],
    "count": 1
  }
}
didi@localhost:~/webroot/face/design/db$

answer:
add:
qid:question id
content :

curl 'http://127.0.0.1/face/ajax/user/answ/add?content=1231231&qid=5' |jq
{
  "errno": 0,
  "errmsg": "ok",
  "data": 2
}

modify:
id :answer id
content:
curl 'http://127.0.0.1/face/ajax/user/answ/edit?content=555555555&id=2' |jq
{
  "errno": 0,
  "errmsg": "OK",
  "data": []
}


收藏:
withid:问题或答案id
type:问题或答案(0 question 1 answer)
curl 'http://127.0.0.1/face/ajax/user/favo/add?withid=2&type=1'|jq
{
  "errno": 0,
  "errmsg": "ok",
  "data": 1
}

删除收藏:
id:收藏id
curl 'http://127.0.0.1/face/ajax/user/favo/del?id=1'|jq
{
  "errno": 0,
  "errmsg": "OK",
  "data": []
}