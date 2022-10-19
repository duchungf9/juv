@if(UserFeatures::managesProfileAvatar())
<div @class(['users-upload-avatar','d-none' => $user->hasAvatar()]) >
    <input type="file"
           class="filepond"
           name="avatar"
           accept="image/png, image/jpeg, image/gif"/>
</div>

<div  @class(['users-avatar','d-none' => !$user->hasAvatar()]) >
    <img src="{{$user->getAvatarUrl()}}" class="users-avatar-image rounded-full">
    <div class="users-avatar-delete" onclick="deleteItem()">
        <svg width="26" height="26" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.586 13l-2.293 2.293a1 1 0 0 0 1.414 1.414L13 14.414l2.293 2.293a1 1 0 0 0 1.414-1.414L14.414 13l2.293-2.293a1 1 0 0 0-1.414-1.414L13 11.586l-2.293-2.293a1 1 0 0 0-1.414 1.414L11.586 13z"
                  fill="currentColor" fill-rule="nonzero"></path>
        </svg>
    </div>
</div>

@once
    @push('scripts')
        <script type="text/javascript">
            const avatar = document.querySelector('.users-avatar')
            const upload_avatar = document.querySelector('.users-upload-avatar');
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImageExifOrientation,
                FilePondPluginImagePreview,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
                FilePondPluginImageEdit
            );
            FilePond.create(
                document.querySelector('input[type="file"]'),
                {
                    labelIdle: `{{__('users.profile.avatar_upload_message')}} <span class="filepond--label-action">Browse</span>`,
                    imagePreviewHeight: 170,
                    imageCropAspectRatio: '1:1',
                    imageResizeTargetWidth: 200,
                    imageResizeTargetHeight: 200,
                    stylePanelLayout: 'compact circle',
                    styleLoadIndicatorPosition: 'center bottom',
                    styleProgressIndicatorPosition: 'right bottom',
                    styleButtonRemoveItemPosition: 'left bottom',
                    styleButtonProcessItemPosition: 'right bottom',
                },
            );
            FilePond.setOptions({
                server: {
                    process: '{{route('user.avatar-upload')}}',
                    revert: '{{route('user.avatar-delete')}}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
            function deleteItem() {
                axios.delete('/it/users/avatar')
                    .then((response) => {
                        if (response.data.status === 'OK') {
                            avatar.classList.add('d-none')
                            upload_avatar.classList.remove('d-none')
                        }
                    })
                    .catch((e) => alert(e))
            }
        </script>
    @endpush
@endonce
@endif
