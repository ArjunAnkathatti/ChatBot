<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatRequest;
use App\ChatResponse;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ChatBot extends Controller
{
	public function getResponse(Request $request) {
    	//$chatMessage = new ChatMessage;

    	//$chatMessage->user_input = $request->input('user_input');
    	//$chatMessage->context = $request->input('context');

    	//make a curl call 

    	//$chatResponse = new ChatResponse;
    	//$chatResponse->response = "Response from VIMAN";
    	//$chatResponse->context = "Present context";

		$user_input = $request->input('user_input');
		//$context_old = $request->input('context');
		$context_old = '{"conversation_id":"3829a880-482a-41f0-abdb-0f934000c2c7","system":{"dialog_stack":[{"dialog_node":"node_8_1510727435692"}],"dialog_turn_counter":1,"dialog_request_counter":1,"_node_output_map":{"node_8_1510727435692":[0]}}}"';


		$user_name = "12d20e4a-6f21-4d76-a6d3-d53336dcc33b";
		$password = "Pkp76O2NsEJ3";
		$url = "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/";
		$workspace_id = "5a69f598-b189-46d7-a832-651ae67f2599";

		$cmd = 'curl -X POST -u"' . $user_name . '":"' . $password . '" --header "Content-Type:application/json" --data "{\"input\":{\"text\": \"' . $user_input . '\"}' .  '}" "' . $url . $workspace_id . '/message?version=2017-05-26"';

		exec($cmd, $result, $status);
		if ($status != 0) {
			$response_text = "error execution the code and the error statu is : " . $status;
		} else {
			//convert the output array into a string
			$json = implode("", $result);
			//convert the json string to an object
			$bot_response = json_decode($json);

			$context_object = $bot_response->context;
			$context_json = json_encode($context_object);
			//text is an array
			$response_text = $bot_response->output->text[0] . '|' . $context_json;
		}
		return $response_text; //->with('context', $context_json);
	}
}
