

var browserInfo = {

    init: function ()
    {
        this.userAgent = navigator.userAgent;
        this.browser = this.searchString( this.browserData ) || "unknown browser";
        this.version = this.searchVersion( navigator.userAgent )
            || this.searchVersion( navigator.appVersion )
            || "unknown version";
        this.OS = this.searchString( this.osData ) || "unknown OS";
    },

    searchString: function ( data )
    {
        for ( var i = 0; i < data.length; i++ ) {
            var dataString = data[i].string;
            var dataProp = data[i].prop;
            this.versionSearchString = data[i].versionSearch || data[i].value;
            if (dataString) {
                if ( dataString.indexOf( data[i].search ) >= 0 )
                    return data[i].value;
            } else if ( dataProp )
                return data[i].value;
        }
    },

    searchVersion: function ( dataString )
    {
        var index = dataString.indexOf( this.versionSearchString );
        if ( index < 0 ) return;
        return parseFloat( dataString.substring( index + this.versionSearchString.length + 1 ) );
    },

    browserData: [
        {
            string: navigator.userAgent,
            search: "Chrome",
            value: "Chrome"
        },
        {   string: navigator.userAgent,
            search: "OmniWeb",
            versionSearch: "OmniWeb/",
            value: "OmniWeb"
        },
        {
            string: navigator.vendor,
            search: "Apple",
            versionSearch: "Version",
            value: "Safari"
        },
        {
            prop: window.opera,
            value: "Opera"
        },
        {
            string: navigator.vendor,
            search: "iCab",
            value: "iCab"
        },
        {
            string: navigator.vendor,
            search: "KDE",
            value: "Konqueror"
        },
        {
            string: navigator.userAgent,
            search: "Firefox",
            value: "Firefox"
        },
        {
            string: navigator.vendor,
            search: "Camino",
            value: "Camino"
        },
        {
            string: navigator.userAgent,
            search: "MSIE",
            versionSearch: "MSIE",
            value: "Internet Explorer"
        },
        {       // for newer Netscapes (6+)
            string: navigator.userAgent,
            search: "Netscape",
            value: "Netscape"
        },
        {       // for other gecko-based browsers
            string: navigator.userAgent,
            search: "Gecko",
            versionSearch: "rv",
            value: "Mozilla"
        },
        {       // for older Netscapes (4-)
            string: navigator.userAgent,
            search: "Mozilla",
            versionSearch: "Mozilla",
            value: "Netscape"
        }
    ],

    osData : [
        {
            string: navigator.platform,
            search: "Win",
            value: "Windows"
        },
        {
            string: navigator.platform,
            search: "Mac",
            value: "Macintosh"
        },
        {
            string: navigator.userAgent,
            search: "iPhone",
            value: "iPhone/iPod"
        },
        {
            string: navigator.platform,
            search: "Linux",
            value: "Linux"
        }
    ]

};

browserInfo.init();
