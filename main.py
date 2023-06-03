import json
data: bytes = b'{"name": "John", "age": 30, "city": "New York"}'
print(json.loads(data))