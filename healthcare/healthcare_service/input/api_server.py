api_request_id = '{"state":"authen","type":"request","value":"get_id"}'
api_request_close = '{"state":"authen","type":"notification","value":"close"}'
api_request_pass = '{"state":"authen","type":"response","value":"pass"}'

api_response_sensor_done = '{"state":"provide","type":"response","value":"sensor","data":"done"}'
api_response_sensor_fail = '{"state":"provide","type":"response","value":"sensor","data":"fail"}'

api_request_error = '{"state":"provide","type":"notification","value":"error"}'

def api_response_time(value , year, month, day, hour, minute, second ):
    json = {
        "state": "provide",
        "type": "response",
        "value": "{}".format(value),
        "data": {
            "time": [hour, minute, second],
            "date": [day, month, year]
            }
    }

    return json


def api_response_sensor(value,heartbeat, oxygen, bloodpressure, bodytemperature):
    json = {
        "state": "provide",
        "type": "response",
        "value": "{}".format(value),
        "data": {
            "heartbeat": heartbeat,
            "oxygen": oxygen,
            "bloodpressure": bloodpressure,
            "bodytemperature": bodytemperature
        }
    }
    return json


def api_response_info(value,sex, yearold, high, weight):
    json = {
        "state": "provide",
        "type": "response",
        "value": "{}".format(value),
        "data": {
            "sex": sex,
            "yearold": yearold,
            "high": high,
            "weight": weight
        }
    }
    return json
