const editor = Jodit.make('#editor', {

    height: 500,

    direction: 'rtl',

    language: 'fa',

    uploader: {

        url: api+'uploadImage',

        headers: {
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content')
        },

        format: 'json',

        isSuccess: function (resp) {
            return resp.success;
        },

        getMessage: function (resp) {
            return resp.message || '';
        },

        process: function (resp) {

            return {
                files: resp.data.files,
                path: '',
                baseurl: '',
                error: resp.error,
                message: resp.message
            };

        },

        defaultHandlerSuccess: function (data) {

            const files = data.files || [];

            if (files.length) {

                files.forEach(file => {

                    this.selection.insertImage(
                        file.url,
                        null,
                        null
                    );

                });

            }

        },

        defaultHandlerError: function (error) {

            console.error(error);

        }

    }

});