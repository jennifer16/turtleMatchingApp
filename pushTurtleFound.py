import requests
import json

header = {"Content-Type": "application/json; charset=utf-8",
          "Authorization": "Basic MDAzZWU5ZWUtODAzMi00ZjhjLTkzYjMtY2FkZjc4NGU2ODI2"}

payload = {"app_id": "a6ac6e35-98b7-469f-a4d6-5494aa309268",
           "included_segments": ["All"],
           "contents": {"en": "New turtle is found!!!"}}

req = requests.post("https://onesignal.com/api/v1/notifications", headers=header, data=json.dumps(payload))

print(req.status_code, req.reason)
