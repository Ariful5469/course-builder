<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #121a27;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }

        /* Form Styles */
        .course-form {
            max-width: 1024px;
            margin: 0 auto;
            padding: 24px;
            background-color: #1e2538;
            border-radius: 10px;
        }

        .form-title {
            font-size: 24px;
            font-weight: 600;
            color: white;
            margin-bottom: 24px;
        }

        /* Input Fields */
        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            color: #b3b3b3;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            background-color: #131926;
            border: 1px solid #2e3544;
            border-radius: 8px;
            padding: 12px;
            color: white;
            font-size: 14px;
        }

        .form-input:focus {
            border-color: #3a4d6a;
            outline: none;
        }

        /* Buttons */
        .add-module-btn, .submit-btn, .add-content-btn {
            background-color: #2c6cf2;
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            border: none;
        }

        .add-module-btn:hover, .submit-btn:hover, .add-content-btn:hover {
            background-color: #3a73f7;
        }

        .submit-btn {
            background-color: #38a169;
        }

        .submit-btn:hover {
            background-color: #48bb78;
        }

        .cancel-btn {
            background-color: #e53e3e;
        }

        .cancel-btn:hover {
            background-color: #f56565;
        }

        /* Modules and Content */
        .modules-wrapper {
            margin-top: 24px;
        }

        .module, .content {
            background-color: #232c39;
            padding: 16px;
            margin-bottom: 24px;
            position: relative;
            border-radius: 8px;
        }

        .remove-btn {
            position: absolute;
            top: 8px;
            right: 8px;
            background-color: #ff6b6b;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 50%;
            cursor: pointer;
        }

        .remove-btn:hover {
            background-color: #ff4f4f;
        }

        .contents-wrapper {
            margin-top: 16px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-3 {
            margin-bottom: 16px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 16px;
        }
    </style>
</head>
<body>

<form action="{{ route('courses.store') }}" method="POST" id="courseForm" class="course-form">
    @csrf
    <h1 class="form-title">Create a Course</h1>
    <p>
        <a href="{{ url()->previous() }}" style="color: #38a169; text-decoration: underline; font-size: 14px;">← Back to Previous Page</a>
    </p>

    <div class="form-group">
        <label class="form-label">Course Title</label>
        <input type="text" name="title" placeholder="Course Title" required class="form-input">
    </div>

    <div class="form-group">
        <label class="form-label">Feature Video</label>
        <input type="text" name="feature_video" placeholder="Feature Video" class="form-input">
    </div>

    <div id="modulesWrapper" class="modules-wrapper"></div>

    <div class="form-group">
        <button type="button" onclick="addModule()" class="add-module-btn mb-3">
            + Module যোগ করুন
        </button>

        <div class="button-group">
            <button type="submit" class="submit-btn">Save</button>
            <a href="{{ url()->previous() }}" class="submit-btn cancel-btn">Cancel</a>
        </div>
    </div>
</form>

<script>
let moduleIndex = 0;

function addModule() {
    const html = `
    <div class="module" id="module-${moduleIndex}">
        <button type="button" class="remove-btn" aria-label="Remove" onclick="removeModule(${moduleIndex})">X</button>
        
        <input type="text" name="modules[${moduleIndex}][title]" placeholder="Module Title" required class="form-input mb-3">

        <div class="contents-wrapper" id="contentsWrapper${moduleIndex}"></div>
        <button type="button" class="add-content-btn" onclick="addContent(${moduleIndex})">+ Content</button>
    </div>`;
    
    document.getElementById('modulesWrapper').insertAdjacentHTML('beforeend', html);
    moduleIndex++;
}

function addContent(moduleIndex) {
    const container = document.getElementById(`contentsWrapper${moduleIndex}`);
    const contentIndex = container.children.length;

    const html = `
        <div class="content" id="content-${moduleIndex}-${contentIndex}">
            <button type="button" class="remove-btn" aria-label="Remove" onclick="removeContent(${moduleIndex}, ${contentIndex})">X</button>
            
            <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][title]" placeholder="Content Title" required class="form-input mb-2">
            <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][video_type]" placeholder="Video Type" class="form-input mb-2">
            <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][video_url]" placeholder="Video URL" class="form-input mb-2">
            <input type="text" name="modules[${moduleIndex}][contents][${contentIndex}][duration]" placeholder="Duration" class="form-input mb-2">
        </div>`;
    
    container.insertAdjacentHTML('beforeend', html);
}

function removeModule(index) {
    const module = document.getElementById(`module-${index}`);
    if (module) {
        module.remove();
    }
}

function removeContent(moduleIndex, contentIndex) {
    const content = document.getElementById(`content-${moduleIndex}-${contentIndex}`);
    if (content) {
        content.remove();
    }
}
</script>

</body>
</html>
