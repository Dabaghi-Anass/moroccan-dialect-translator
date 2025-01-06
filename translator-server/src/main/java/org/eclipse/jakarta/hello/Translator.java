package org.eclipse.jakarta.hello;

import java.net.URI;
import java.net.http.HttpClient;
import java.net.http.HttpRequest;
import java.net.http.HttpResponse;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import jakarta.ws.rs.Consumes;
import jakarta.ws.rs.POST;
import jakarta.ws.rs.Path;
import jakarta.ws.rs.Produces;
import jakarta.ws.rs.core.MediaType;
import jakarta.ws.rs.core.Response;
import jakarta.ws.rs.core.Response.ResponseBuilder;

@Path("translate")
public class Translator {
	private String systemInstructions = "you are a translator from english to moroccan arabic (darija) and vise versa, you will receive a text and from and to and translate it don't make up extra words JUST THE TRANSLATION";
	public String GEMINI_API_KEY = "<YOUR_GEMINI_API_KEY>";
	public String geminiUrl = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent?key="+GEMINI_API_KEY;
	public record TranslationRequest(String text, String from, String to) {}
	public record TranslationResponse(String translatedText) {}
	
	
	private String _formTranslationRequest(TranslationRequest request) {
		return String.format("from=%s;to=%s;text=%s;", request.from(), request.to(), request.text());
	}

    private  String sendGeminiRequest(TranslationRequest translationRequest){
    	try {
            String prompt = _formTranslationRequest(translationRequest);
            String jsonRequestBody = String.format("{"
                    + "\"contents\": ["
                    + "    {"
                    + "      \"role\": \"model\","
                    + "      \"parts\": ["
                    + "        {"
                    + "          \"text\": \"%s\""
                    + "        }"
                    + "      ]"
                    + "    },"
                    + "    {"
                    + "      \"role\": \"user\","
                    + "      \"parts\": ["
                    + "        {"
                    + "          \"text\": \"%s\""
                    + "        }"
                    + "      ]"
                    + "    }"
                    + "  ],"
                    + "\"generationConfig\": {"
                    + "   \"temperature\": 1,"
                    + "    \"topK\": 40,"
                    + "    \"topP\": 0.95,"
                    + "    \"maxOutputTokens\": 8192,"
                    + "    \"responseMimeType\": \"text/plain\""
                    + "  }"
                    + "}", systemInstructions, prompt);


            HttpRequest request = HttpRequest.newBuilder()
                .uri(URI.create("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-8b:generateContent?key=" + GEMINI_API_KEY))
                .header("Content-Type", "application/json")
                .POST(HttpRequest.BodyPublishers.ofString(jsonRequestBody))
                .build();

            HttpClient client = HttpClient.newHttpClient();
            HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
            String body = response.body().toString();
            String regex = "\"text\"\\s*:\\s*\"([^\"]*)\"";
            Pattern pattern = Pattern.compile(regex);
            Matcher matcher = pattern.matcher(body);

            // Extract and print all matches
            while (matcher.find()) {
                String extractedText = matcher.group(1);
                return extractedText.replace("\\n", "");
            }
            return "error occured";
        } catch (Exception e) {
            e.printStackTrace();
            return "error occured";
        }
    }
	@POST
    @Consumes(MediaType.APPLICATION_JSON)
    @Produces(MediaType.APPLICATION_JSON)
    public Response translate(TranslationRequest request) {
		String translatedText = sendGeminiRequest(request);
        TranslationResponse response = new TranslationResponse(translatedText);
        ResponseBuilder responseBuilder = Response.ok(response);
        responseBuilder.header("Access-Control-Allow-Origin", "*");
        responseBuilder.header("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE");
        responseBuilder.header("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With");

        return responseBuilder.build();
    }
}