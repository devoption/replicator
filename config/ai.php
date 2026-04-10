<?php

return [
    'default' => env('AI_DEFAULT_PROVIDER', 'ollama'),
    'default_for_images' => env('AI_DEFAULT_FOR_IMAGES', 'ollama'),
    'default_for_audio' => env('AI_DEFAULT_FOR_AUDIO', 'ollama'),
    'default_for_transcription' => env('AI_DEFAULT_FOR_TRANSCRIPTION', 'ollama'),
    'default_for_embeddings' => env('AI_DEFAULT_FOR_EMBEDDINGS', 'ollama'),
    'default_for_reranking' => env('AI_DEFAULT_FOR_RERANKING', 'ollama'),

    'providers' => [
        'ollama' => [
            'driver' => 'ollama',
            'key' => env('OLLAMA_API_KEY', ''),
            'url' => env('OLLAMA_BASE_URL', 'http://localhost:11434'),
            'model' => env('OLLAMA_MODEL', 'llama3.1'),
        ],
    ],
];
