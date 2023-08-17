const faviconURL = '../../../assets/images/evergreen-logo(without background).png'; // Modify with your actual path

function setFavicon() {
    const link = document.querySelector("link[rel*='icon']") || createFaviconLink();
    link.type = 'image/x-icon';
    link.rel = 'shortcut icon';
    link.href = faviconURL;
    document.getElementsByTagName('head')[0].appendChild(link);
}

function createFaviconLink() {
    const link = document.createElement('link');
    link.id = 'dynamicFavicon';
    return link;
}

setFavicon();

