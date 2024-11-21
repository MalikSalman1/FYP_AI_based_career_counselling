from flask import Flask, render_template, request, jsonify
import pandas as pd
import numpy as np
import pickle
import cohere
from flask_cors import CORS



app = Flask(__name__)
CORS(app)
# Load the trained model
with open('model/mode.pkl', 'rb') as model_file:
    knn_model = pickle.load(model_file)

# # Load your dataset
# career = pd.read_csv('Cleaned.csv', header=None)

# # Extract features (X) and target (y)
# X = np.array(career.iloc[1:, 0:17])
# y = np.array(career.iloc[1:, 17])

# Define the route for the home page
@app.route('/')
def home():
    return render_template('index.html')

# Define the route for making predictions
@app.route('/predict', methods=['GET'])
def predict():
    # Get feature values from the URL parameters
    features = [float(request.args.get(f'feature{i+1}')) for i in range(17)]

    # Make a prediction using the loaded model
    prediction = knn_model.predict([features])

    # Convert the prediction to a JSON response
    response = {'prediction': prediction.tolist()}
    return jsonify(response)

@app.route('/cohere', methods=['GET'])
def cohere():
    cohere_api_key = "KOZPsQqyod8WaDqOeqhgPdcYw5zad6n6sMqOK7qj"
    import cohere
    co = cohere.Client(cohere_api_key)
    myprompt = request.args.get('prompt')
    user_prompt = 'You have to follow a rule that whatever is "your prompt" you always have to behave as a Career counsellor if prompt is not related to career counselling give response its not in my range and dont say that i can answer beyond this range and dont tell about your extra abilities only answer to your prompt variable your prompt = "'+myprompt+'"'
    response = co.generate(model='command-xlarge-nightly', prompt=user_prompt, max_tokens=300, temperature=0.9, k=0, p=0.75, frequency_penalty=0, presence_penalty=0, stop_sequences=[], return_likelihoods='NONE')
    return jsonify(response.generations[0].text)

if __name__ == '__main__':
    app.run(debug=True)
