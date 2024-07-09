<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Email Preview') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-2">To: {{ $validated['to'] }}</h3>
                    <h3 class="text-lg font-semibold mb-2">Subject: {{ $validated['subject'] }}</h3>
                    <div class="mb-4">
                        <h4 class="text-md font-semibold mb-2">Body:</h4>
                        <p class="whitespace-pre-wrap">{{ $validated['body'] }}</p>
                    </div>
                    <div class="mb-4">
                        <h4 class="text-md font-semibold mb-2">Attachments:</h4>
                        <ul class="list-disc list-inside">
                            @foreach($pdfNames as $pdfName)
                                <li>{{ $pdfName }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ route('email-formatter.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="to" value="{{ $validated['to'] }}">
                        <input type="hidden" name="subject" value="{{ $validated['subject'] }}">
                        <input type="hidden" name="body" value="{{ $validated['body'] }}">
                        @foreach($validated['pdfs'] as $key => $pdf)
                            <input type="file" name="pdfs[]" value="{{ $pdf }}" hidden>
                        @endforeach
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Send Email
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>