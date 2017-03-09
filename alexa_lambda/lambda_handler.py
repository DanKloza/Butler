import urllib2
import json


def lambda_handler(event, context):
    #    if (event["session"]["application"]["applicationId"] !=
    #            "amzn1.echo-sdk-ams.app.bd304b90-xxxx-xxxx-xxxx-xxxxd4772bab"):
    #        raise ValueError("Invalid Application ID")

    if event["session"]["new"]:
        on_session_started({"requestId": event["request"][
                           "requestId"]}, event["session"])

    if event["request"]["type"] == "LaunchRequest":
        return on_launch(event["request"], event["session"])
    elif event["request"]["type"] == "IntentRequest":
        return on_intent(event["request"], event["session"])
    elif event["request"]["type"] == "SessionEndedRequest":
        return on_session_ended(event["request"], event["session"])


def on_session_started(session_started_request, session):
    print "Starting new session."


def on_launch(launch_request, session):
    return get_welcome_response()


def on_intent(intent_request, session):
    intent = intent_request["intent"]

    intent_name = intent_request["intent"]["name"]
    user_id = session["user"]["userId"]
    print("The intent name is: " + intent_name)
    print("The user_id is: " + user_id)

    if intent_name == "AddItem":
        return add_item(intent, user_id)
    elif intent_name == "GetItem":
        return get_item()
    elif intent_name == "AMAZON.HelpIntent":
        return get_welcome_response()
    elif intent_name == "AMAZON.CancelIntent" or intent_name == "AMAZON.StopIntent":
        return handle_session_end_request()
    else:
        raise ValueError("Invalid intent")


def on_session_ended(session_ended_request, session):
    print "Ending session."
    # Cleanup goes here...


def handle_session_end_request():
    card_title = "K seeya dude"
    speech_output = "Bye boy"
    should_end_session = True

    return build_response({},
                          build_speechlet_response(card_title,
                                                   speech_output,
                                                   None,
                                                   should_end_session))


def add_item(intent, user_id):
    card_title = "It's cookin' time homeboy"

    if "Subject" in intent["slots"]:
        subject = intent["slots"]["Subject"]["value"]

    if "my" in subject:
        output = subject.replace("my", "your")
        speech_output = "Okay, I'll remind you to " + \
            output
    else:
        output = subject
        speech_output = "Okay, I'll remind you to " + output

    data = {}
    data["name"] = "boss"

    should_end_session = True
    return build_response({}, build_speechlet_response(card_title,
                                                       speech_output,
                                                       None,
                                                       should_end_session))


def get_item():
    card_title = "It's cookin' time homesqueeze"
    speech_output = "Executing get_item intent handler"
    should_end_session = True
    return build_response({}, build_speechlet_response(card_title,
                                                       speech_output,
                                                       None,
                                                       should_end_session))


def get_welcome_response():
    session_attributes = {}
    card_title = "BUTLER"
    speech_output = "Welcome to the HackIllinois2017. Eat some candy. "

    reprompt_text = "You heard me. Eat some candy."
    should_end_session = False
    return build_response(session_attributes, build_speechlet_response(
        card_title, speech_output, reprompt_text, should_end_session))


def build_speechlet_response(title, output, reprompt_text, should_end_session):
    return {
        "outputSpeech": {
            "type": "PlainText",
            "text": output
        },
        "card": {
            "type": "Simple",
            "title": title,
            "content": output
        },
        "reprompt": {
            "outputSpeech": {
                "type": "PlainText",
                "text": reprompt_text
            }
        },
        "shouldEndSession": should_end_session
    }


def build_response(session_attributes, speechlet_response):
    return {
        "version": "1.0",
        "sessionAttributes": session_attributes,
        "response": speechlet_response
    }
