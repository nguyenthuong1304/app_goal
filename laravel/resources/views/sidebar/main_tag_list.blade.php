<div class="card mb-4 sidebar-content">
    <div class="card-header text-center"><i class="fas fa-tags mr-2"></i>{{ __('common.main_tag') }}</div>
    <div class="card-body main-tag-list py-3 mx-auto">
        <a href="{{
            \App\Models\Tag::where('name', 'status')->first()
            ? route('tags.show', ['name' => 'status'])
            : ''
        }}">
            <span class="badge p-1 rounded-pill bg-primary"><i class="fas fa-tags ml-1"></i> status</span>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'family')->first()
            ? route('tags.show', ['name' => 'family'])
            : ''
        }}">
            <span class="badge p-1 rounded-pill bg-primary"><i class="fas fa-tags ml-1"></i> family</span>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'health')->first()
            ? route('tags.show', ['name' => 'health'])
            : ''
        }}">
            <span class="badge p-1 rounded-pill bg-primary"><i class="fas fa-tags ml-1"></i> health</span>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'reflection/awareness')->first()
            ? route('tags.show', ['name' => 'reflection/awareness'])
            : ''
        }}">
            <span class="badge p-1 rounded-pill bg-primary"><i class="fas fa-tags ml-1"></i> reflection/awareness</span>
        </a>
        <a href="{{
            \App\Models\Tag::where('name', 'question')->first()
            ? route('tags.show', ['name' => 'question'])
            : ''
        }}">
            <span class="badge p-1 rounded-pill bg-primary"><i class="fas fa-tags ml-1"></i> question</span>
        </a>
    </div>
</div>
