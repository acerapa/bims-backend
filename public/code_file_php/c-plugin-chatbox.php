

    <!-- 
        Add the chatbot plugin in footer section
    -->
    <script type="text/javascript" src="<?php echo $plugin_assets_cdn; ?>js/plugin_chatbox.js"></script>
    <script type="text/javascript">
        const config = {
                theme: {
                header: '#448aff',
                body: 'white',
                footer: 'white'
            },
            user_is_new: true,
            user_profile: Plugin_auth.getLocalUser(),
            recepient: [
                {
                    user_refid:'USR-1234567899-XCD',
                    name: 'Jason Lipreso',
                    email: 'jasonlipreso@gmail.com',
                },
                {
                    user_refid:'USR-812783456-KLA',
                    name: 'Tresha Casonggay',
                    email: 'treshacasongay@gmail.com',
                }
            ],
            subject: 'Canyoneering sa Badian',
            subject_refid: 'XXX-023345465575-XXX',
            subject_link: 'https://mcrichtravel.com/package.php?package=PCK-12292022095654-75M'

        };
        Plugin_chatbox.init(config);
    </script>