<div class="photoUpload-zone">
    <div class="photoUpload-detail" id="photoUpload-preview-{{ $key }}">
        @if (!empty($photoDetail['image']))
            <a>
                <img class="rounded" onerror="this.src='../assets/images/noimage.png';"
                    src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}" alt="Alt photo" title="Alt photo" />
            </a>
        @else
            <img class="rounded" onerror="this.src='../assets/images/noimage.png';"
                src="{{ upload($photoDetail['upload'], $photoDetail['image']) }}" alt="Alt photo" title="Alt photo" />
        @endif
    </div>
    <input type="hidden" name="additionalData" id="additionalData" value="someAdditionalData">
    <div id="cropDimensions-{{ $key }}" class="cropDimensions red text-center">
        Kích thước vùng crop: <span class="cropWidth" id="cropWidth-{{ $key }}">0</span> x <span
            class="cropHeight" id="cropHeight-{{ $key }}">0</span> px
    </div>
    <div class="m-3 text-center flex-crop">
        <button id="cropButton-{{ $key }}" type="button" class="cropButton  btn-primary btn-crop-img">Cắt
            ảnh</button>
        <button id="saveButton-{{ $key }}" type="button" class="saveButton  btn-primary btn-crop-img">Lưu
            ảnh</button>
    </div>
    <label class="photoUpload-file" id="photo-zone-{{ $key }}" for="file-zone-{{ $key }}">
        <input type="file" class="file-zone-{{ $key }}" name="file-{{ $key }}"
            id="file-zone-{{ $key }}">
        <input type="hidden" class="cropFile" name="cropFile-{{ $key }}"
            id="cropFile-{{ $key }}">
        <i class="ti ti-cloud-upload"></i>
        <p class="photoUpload-drop">Kéo và thả hình vào đây</p>
        <p class="photoUpload-or">Hoặc</p>
        <p class="photoUpload-choose btn btn-sm">Chọn hình</p>
    </label>
    <div class="photoUpload-dimension">{{ $photoDetail['dimension'] }}</div>
</div>