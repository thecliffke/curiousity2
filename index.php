<!DOCTYPE html>
<html lang="en">
<?php ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curiosity Core: Random Fact Generator</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Use Inter font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            transition: background-color 0.5s ease-in-out;
            /* Smoother background transition */
            background-image: linear-gradient(135deg, #f0e6ff 0%, #e0eaff 100%);
            /* Soft gradient background */
        }

        /* Custom shadow for a fancier look */
        .shadow-3xl {
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.2);
        }

        /* Custom styles for glowing button effect */
        .btn-glow {
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
            /* Base glow */
        }

        .btn-glow:hover {
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.6);
            /* Enhanced glow on hover */
            transform: translateY(-2px);
        }

        .btn-glow:active {
            transform: translateY(0);
            box-shadow: 0 3px 10px rgba(139, 92, 246, 0.3);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    <div id="app-container"
        class="w-full max-w-lg bg-white rounded-3xl shadow-2xl p-8 transition-all duration-300 transform scale-100 hover:shadow-3xl border border-indigo-100">

        <header class="text-center mb-8 flex flex-col items-center">
            <h1
                class="text-5xl font-extrabold text-indigo-700 mb-3 tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-purple-600">
                Curiosity Core ✨
            </h1>
            <p class="text-xl text-gray-600 mb-4 font-medium">Unlock Your Daily Dose of Wonder!</p>

            <!-- Fact Streak Counter - The exciting target! -->
            <div id="streak-display"
                class="bg-gradient-to-r from-pink-400 to-yellow-400 text-white font-bold py-1.5 px-5 rounded-full shadow-lg text-md transition-all duration-300 transform scale-100 border-2 border-white">
                Fact Streak: 0
            </div>
        </header>

        <!-- Input Section -->
        <div class="space-y-6">
            <div>
                <label for="sector-select" class="block text-sm font-semibold text-gray-700 mb-2">
                    Choose Your Realm of Knowledge
                </label>
                <select id="sector-select"
                    class="block w-full py-3 px-4 border border-indigo-300 bg-indigo-50 rounded-xl shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-lg appearance-none transition duration-150 ease-in-out text-gray-800">
                    <option value="All" selected class="text-gray-700">All Categories (Cosmic Randomness!)</option>
                    <option value="Technology">Technology & AI 💻</option>
                    <option value="Space">Space & Astronomy 🌌</option>
                    <option value="History">World History 📜</option>
                    <option value="Nature">Nature & Wildlife 🌿</option>
                    <option value="Finance">Business & Finance 📈</option>
                    <option value="Art">Art & Culture 🎨</option>
                    <option value="Health">Health & Wellness ❤️</option>
                    <option value="ScienceMath">Science & Math 🧪</option>
                </select>
            </div>

            <button id="get-fact-button"
                class="w-full flex items-center justify-center py-3.5 px-4 border border-transparent text-xl font-bold rounded-xl text-white bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-70 shadow-lg btn-glow disabled:opacity-60 disabled:cursor-not-allowed">
                <span id="button-text">Generate New Fact!</span>
                <svg id="loading-spinner" class="animate-spin -ml-1 mr-3 h-6 w-6 text-white hidden"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Fact Display Area -->
        <div class="mt-8">
            <h2
                class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-indigo-200 pb-3 flex items-center bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-500">
                <svg class="w-7 h-7 mr-2 text-indigo-500 inline-block align-middle" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.663 17h4.673M12 3v14m0 0l-4-4m4 4l4-4"></path>
                </svg>
                Your Daily Fact Gem 💎
            </h2>
            <div id="fact-card"
                class="min-h-[140px] bg-gradient-to-br from-indigo-50 to-purple-50 border border-indigo-200 p-6 rounded-2xl transition-all duration-500 flex flex-col justify-center shadow-inner">
                <p id="fact-text" class="text-xl font-semibold text-gray-800 italic text-center leading-relaxed">
                    Select your favorite sector or go for "All" and hit "Generate New Fact!" to unveil something truly
                    amazing!
                </p>
                <div id="citation-area"
                    class="mt-5 text-sm text-indigo-800 font-medium hidden border-t border-indigo-200 pt-3">
                    <p class="font-bold mb-1 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.102 1.101M12 12h.01">
                            </path>
                        </svg>
                        Source(s):
                    </p>
                    <ul id="sources-list" class="list-disc list-inside space-y-1 text-indigo-700">
                        <!-- Sources will be injected here -->
                    </ul>
                </div>
                <div id="error-message"
                    class="text-red-600 font-bold mt-3 text-center hidden bg-red-50 p-3 rounded-lg border border-red-200">
                    <!-- Error messages will be injected here -->
                </div>
            </div>

            <!-- Share Button Area (New) -->
            <div id="share-area" class="mt-4 flex justify-end hidden">
                <button id="share-button"
                    class="py-1.5 px-4 text-sm font-semibold rounded-lg text-white bg-purple-600 hover:bg-purple-700 transition shadow-lg flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.885 13.97 9.206 14.537 9.664 15c.348.348.868.683 1.542.864 1.12.302 2.218.067 2.858-.459.64-.526.86-1.29.61-1.928-.25-.638-.72-1.12-1.35-1.35s-1.34-.25-1.928.61c-.526.64-.75 1.738-.459 2.858.181.674.516 1.194.864 1.542z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 21v-8m0 0l-3-3m3 3l3-3"></path>
                    </svg>
                    <span id="share-button-text">Share Fact (Copy)</span>
                </button>
                <span id="share-status" class="ml-3 text-sm font-medium hidden self-center"></span>
            </div>
        </div>
    </div>

    <script type="module">
        // --- Firebase Configuration & Global Variables (Required Context) ---
        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        // --- DOM Elements ---
        const factText = document.getElementById('fact-text');
        const citationArea = document.getElementById('citation-area');
        const sourcesList = document.getElementById('sources-list');
        const errorMessageDiv = document.getElementById('error-message');
        const sectorSelect = document.getElementById('sector-select');
        const getFactButton = document.getElementById('get-fact-button');
        const buttonText = document.getElementById('button-text');
        const loadingSpinner = document.getElementById('loading-spinner');
        const streakDisplay = document.getElementById('streak-display'); // New DOM element for the streak
        const appContainer = document.getElementById('app-container');
        // New DOM elements for Share feature
        const shareButton = document.getElementById('share-button');
        const shareArea = document.getElementById('share-area');
        const shareStatus = document.getElementById('share-status');

        // --- State and API Configuration ---
        let factStreak = 0; // State variable for the fact streak
        const API_KEY = "AIzaSyCoygcTxphlHa1EpTptx7EDJDseNy7dNhg";
        const MODEL_NAME = "gemini-2.5-flash-preview-09-2025";
        const API_URL =
            `https://generativelanguage.googleapis.com/v1beta/models/${MODEL_NAME}:generateContent?key=${API_KEY}`;

        // --- Utility Functions ---

        /**
         * Clears previous content and displays an error message.
         * @param {string} message 
         */
        const displayError = (message) => {
            // Reset streak on error
            factStreak = 0;
            streakDisplay.textContent = `Fact Streak: ${factStreak}`;
            streakDisplay.classList.remove('scale-110', 'bg-gradient-to-r', 'from-green-400', 'to-blue-400', 'ring-2',
                'ring-green-600');
            streakDisplay.classList.add('from-pink-400', 'to-yellow-400', 'border-white');


            factText.textContent = "Oops! Something went wrong. Please try again later!";
            factText.classList.add('text-red-500');
            errorMessageDiv.textContent = message;
            errorMessageDiv.classList.remove('hidden');
            citationArea.classList.add('hidden');
            shareArea.classList.add('hidden'); // Hide share on error

            appContainer.classList.add('animate-shake'); // Add shake animation on error
            setTimeout(() => {
                appContainer.classList.remove('animate-shake');
            }, 500);
        };

        /**
         * Clears error messages and resets text styling.
         */
        const clearFeedback = () => {
            factText.classList.remove('text-red-500');
            errorMessageDiv.classList.add('hidden');
            citationArea.classList.add('hidden');
            sourcesList.innerHTML = '';
            // Hide share elements
            shareArea.classList.add('hidden');
            shareStatus.classList.add('hidden');
        };

        /**
         * Implements exponential backoff for API calls.
         */
        const fetchWithExponentialBackoff = async (url, options, maxRetries = 3) => {
            for (let i = 0; i < maxRetries; i++) {
                try {
                    const response = await fetch(url, options);
                    if (response.ok) {
                        return response;
                    }
                    // Handle rate limiting (429) or other retryable errors
                    if (response.status === 429 || response.status >= 500) {
                        throw new Error(`Retryable API Error: ${response.status}`);
                    }
                    // For client errors (4xx), stop and throw
                    const errorJson = await response.json();
                    throw new Error(`API Error: ${response.status} - ${errorJson.error.message}`);
                } catch (error) {
                    if (i === maxRetries - 1) {
                        throw error; // Last retry failed
                    }
                    const delay = Math.pow(2, i) * 1000 + Math.random() * 1000;
                    // Note: Logging is commented out to adhere to instructions.
                    // console.debug(`Request failed, retrying in ${delay}ms...`, error.message);
                    await new Promise(resolve => setTimeout(resolve, delay));
                }
            }
        };

        /**
         * Calls the Gemini API to generate a fact.
         */
        const generateFact = async () => {
            clearFeedback();
            getFactButton.disabled = true;
            buttonText.textContent = "Unveiling Wisdom...";
            loadingSpinner.classList.remove('hidden');
            factText.textContent = "Searching the knowledge universe...";

            const selectedSector = sectorSelect.value;
            const sectorText = selectedSector === 'All' ? 'any topic' : selectedSector;

            // System instructions updated to emphasize variety and a bit more intriguing tone
            const systemPrompt =
                "You are an expert fact curator and storyteller. Provide a single, truly unique, extremely interesting, short, and concise random fact. Craft it to spark wonder. Do not use any titles, headings, or list markers. Just the captivating fact text.";

            // Adding a random seed to the user query encourages the model to generate a diverse response each time, improving randomness.
            const randomSeed = Math.random().toString(36).substring(7);
            const userQuery =
                `Provide a unique and verified fact about ${sectorText}. Ensure it is distinct from previous facts. Random seed for variety: ${randomSeed}`;

            const payload = {
                contents: [{
                    parts: [{
                        text: userQuery
                    }]
                }],
                // Use Google Search for up-to-date and verified information
                tools: [{
                    "google_search": {}
                }],
                systemInstruction: {
                    parts: [{
                        text: systemPrompt
                    }]
                },
            };

            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(payload)
            };

            try {
                const response = await fetchWithExponentialBackoff(API_URL, options);
                const result = await response.json();

                const candidate = result.candidates?.[0];

                if (!candidate || !candidate.content?.parts?.[0]?.text) {
                    throw new Error("Received an empty or malformed response from the API.");
                }

                // 1. Extract the generated text
                const factContent = candidate.content.parts[0].text.trim();

                // --- STREAK LOGIC UPDATE ---
                factStreak++;
                streakDisplay.textContent = `Fact Streak: ${factStreak}`;

                // Milestone check and celebration message
                if (factStreak > 0 && factStreak % 5 === 0) {
                    const message = factStreak === 5 ?
                        "🌟 Fantastic! 5-Fact Streak!" :
                        `🏆 You're on fire! Streak x${factStreak}!`;

                    factText.innerHTML =
                        `<span class="text-green-600 font-bold">${message}</span><br><br>${factContent}`;
                    streakDisplay.classList.remove('from-pink-400', 'to-yellow-400', 'border-white');
                    streakDisplay.classList.add('scale-110', 'from-green-400', 'to-blue-400', 'ring-2',
                        'ring-green-600');
                    setTimeout(() => {
                        streakDisplay.classList.remove('scale-110', 'from-green-400', 'to-blue-400',
                            'ring-2', 'ring-green-600');
                        streakDisplay.classList.add('from-pink-400', 'to-yellow-400', 'border-white');
                    }, 800);
                } else {
                    factText.textContent = factContent;
                }
                // End STREAK LOGIC UPDATE

                // 2. Extract and display grounding sources (citations)
                let sources = [];
                const groundingMetadata = candidate.groundingMetadata;
                if (groundingMetadata && groundingMetadata.groundingAttributions) {
                    sources = groundingMetadata.groundingAttributions
                        .map(attribution => ({
                            uri: attribution.web?.uri,
                            title: attribution.web?.title,
                        }))
                        .filter(source => source.uri && source.title);
                }

                if (sources.length > 0) {
                    citationArea.classList.remove('hidden');
                    sources.forEach(source => {
                        const li = document.createElement('li');
                        li.innerHTML =
                            `<a href="${source.uri}" target="_blank" class="text-indigo-600 hover:text-indigo-800 hover:underline transition">${source.title || source.uri}</a>`;
                        sourcesList.appendChild(li);
                    });
                }

                // Show share button on success
                shareArea.classList.remove('hidden');

                // Animate background color change to acknowledge successful fact loading
                document.body.classList.add('bg-purple-50');
                setTimeout(() => {
                    document.body.classList.remove('bg-purple-50');
                    document.body.style.backgroundImage =
                        'linear-gradient(135deg, #f0e6ff 0%, #e0eaff 100%)'; // Reset to initial gradient
                }, 100);

            } catch (error) {
                console.error("Fact Generation Error:", error);
                displayError(
                    `Failed to fetch the fact. Please try again. Error: ${error.message.substring(0, 100)}...`);
                factStreak = 0; // Reset streak on error/failure to fetch
                streakDisplay.textContent = `Fact Streak: ${factStreak}`;
            } finally {
                getFactButton.disabled = false;
                buttonText.textContent = "Generate New Fact!";
                loadingSpinner.classList.add('hidden');
            }
        };

        /**
         * Displays a temporary status message for the share action.
         */
        const showShareStatus = (message, isSuccess) => {
            shareStatus.textContent = message;
            shareStatus.classList.remove('hidden', 'text-green-600', 'text-red-600');
            shareStatus.classList.add(isSuccess ? 'text-green-600' : 'text-red-600');

            // Temporarily hide status after a few seconds
            setTimeout(() => {
                shareStatus.classList.add('hidden');
            }, 3000);
        };

        /**
         * Copies the current fact and streak status to the clipboard.
         */
        const shareFact = async () => {
            const fact = factText.textContent.trim();
            const streak = factStreak;

            const shareText =
                `🧠 Curiosity Core Fact (Streak: ${streak}):\n\n"${fact}"\n\nUnveil your own wonder: [Link to this app/site]\n#RandomFact #Knowledge`;

            try {
                // Attempt to use modern clipboard API
                await navigator.clipboard.writeText(shareText);
                showShareStatus("Copied to clipboard!", true);
            } catch (err) {
                // Fallback for environments where clipboard API is restricted
                const tempTextArea = document.createElement('textarea');
                tempTextArea.value = shareText;
                // Move off-screen to avoid visual disruption
                tempTextArea.style.position = 'absolute';
                tempTextArea.style.left = '-9999px';
                document.body.appendChild(tempTextArea);
                tempTextArea.select();
                try {
                    document.execCommand('copy');
                    showShareStatus("Copied to clipboard!", true);
                } catch (execErr) {
                    showShareStatus("Copy failed. Please copy manually.", false);
                    console.error('Fallback copy failed:', execErr);
                }
                document.body.removeChild(tempTextArea);
            }
        };

        // --- Event Listeners ---
        getFactButton.addEventListener('click', generateFact);
        shareButton.addEventListener('click', shareFact); // New listener

        // Add a subtle shake animation for the app container on error
        const styleSheet = document.createElement('style');
        styleSheet.type = 'text/css';
        styleSheet.innerText = `@keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .animate-shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }`;
        document.head.appendChild(styleSheet);
    </script>
</body>

</html>
