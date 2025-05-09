@extends('welcome')

@section('content')
    <h2 class="page-title">All Modules</h2>

    <!-- Search Form -->
    <form action="{{ route('modules.index') }}" method="GET" class="search-form mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search by module title" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <div class="accordion" id="modulesAccordion">
        @forelse ($modules as $index => $module)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $index }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                        <strong>Module:</strong> {{ $module->title }}
                    </button>
                </h2>
                <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#modulesAccordion">
                    <div class="accordion-body">
                        @if($module->contents->count())
                            <ul class="list-group">
                                @foreach($module->contents as $content)
                                    <li class="list-group-item content-item">
                                        <strong>Title:</strong> {{ $content->title }}<br>
                                        <strong>Video Type:</strong> {{ $content->video_type }}<br>
                                        <strong>Video URL:</strong> <a href="{{ $content->video_url }}" target="_blank">{{ $content->video_url }}</a><br>
                                        <strong>Duration:</strong> {{ $content->duration }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No contents found for this module.</p>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>No modules found.</p>
        @endforelse
    </div>

  

@endsection

@section('styles')
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Page Title */
        .page-title {
            color: #2c3e50;
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
        }

        /* Search Form */
        .search-form .input-group {
            max-width: 600px;
            margin: 0 auto 20px;
        }

       .search-form .form-control {
    padding: 18px; /* increased from 12px */
    font-size: 1.1em;
    border-radius: 8px;
    border: 1px solid #ced4da;
    height: 60px; /* added for consistent height */
}

.search-form .btn {
    padding: 18px 25px; /* match the input height */
    font-size: 1.1em;
    border-radius: 8px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    height: 60px; /* ensure equal height */
}

        .search-form .btn:hover {
            background-color: #0056b3;
        }

        /* Accordion Styles */
        .accordion-item {
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .accordion-button {
            background-color: #4CAF50;
            color: white;
            font-size: 1.1em;
            padding: 15px 20px;
            border-radius: 8px;
            text-align: left;
            width: 100%;
        }

        .accordion-button.collapsed {
            background-color: #9e9e9e;
        }

        .accordion-button:hover {
            background-color: #388e3c;
        }

        .accordion-body {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Content List Styles */
        .content-item {
            margin-bottom: 15px;
            padding: 15px;
            background-color: #fafafa;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .content-item strong {
            color: #4CAF50;
        }

        .content-item a {
            color: #007bff;
            text-decoration: none;
        }

        .content-item a:hover {
            text-decoration: underline;
        }

        /* Module Addition Styles */
        .module-wrapper {
            margin-top: 40px;
        }

        .module {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .module input {
            margin-bottom: 15px;
            padding: 12px;
            font-size: 1em;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #ced4da;
        }

        .module button {
            padding: 12px 20px;
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .module button:hover {
            background-color: #c82333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 2em;
            }

            .accordion-button {
                font-size: 1em;
            }

            .accordion-body {
                padding: 15px;
            }

            .module input {
                font-size: 0.9em;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        let moduleIndex = 0;

        function addModule() {
            const wrapper = document.createElement('div');
            wrapper.classList.add('module');
            wrapper.setAttribute('data-module-index', moduleIndex);

            wrapper.innerHTML = `
                <div style="display: flex; align-items: center; gap: 15px;">
                    <input type="text" name="modules[${moduleIndex}][title]" placeholder="Module Title" required style="flex: 1;">
                    <button type="button" onclick="removeModule(this)" style="color: red; font-weight: bold;">&times;</button>
                </div>
                <div class="contentsWrapper" id="contentsWrapper${moduleIndex}"></div>
                <button type="button" onclick="addContent(${moduleIndex})" class="btn btn-primary">+ Add Content</button>
                <hr>
            `;

            document.getElementById('modulesWrapper').appendChild(wrapper);
            moduleIndex++;
        }

        function removeModule(button) {
            const moduleDiv = button.closest('.module');
            moduleDiv.remove();
        }

        function addContent(moduleIndex) {
            const container = document.getElementById(`contentsWrapper${moduleIndex}`);
            const contentIndex = container.children.length;

            let html = `
                <div class="content" style="margin-left: 20px; margin-top: 10px;">
                    <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][title]" placeholder="Content Title" required>
                    <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][video_type]" placeholder="Video Type">
                    <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][video_url]" placeholder="Video URL">
                    <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][duration]" placeholder="Duration">
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
    </script>
@endsection
