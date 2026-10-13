"""Gera páginas HTML de redirecionamento (substitui o mkdocs-redirects).

Os redirecionamentos são definidos em `extra.redirect_maps` no properdocs.yml,
mapeando URLs antigas (.html) para páginas Markdown da documentação.
"""

import logging
import os
import posixpath

log = logging.getLogger("properdocs.hooks.redirects")

_redirects = {}
_doc_pages = {}

_TEMPLATE = """<!doctype html>
<html lang="pt">
<head>
<meta charset="utf-8">
<title>Redirecionando&hellip;</title>
<meta http-equiv="refresh" content="0; url={url}">
<link rel="canonical" href="{url}">
</head>
<body>
<p>Esta página foi movida para <a href="{url}">{url}</a>.</p>
</body>
</html>
"""


def on_config(config):
    _redirects.update(config.get("extra", {}).get("redirect_maps", {}))
    return config


def on_files(files, config, **kwargs):
    _doc_pages.clear()
    for page in files.documentation_pages():
        _doc_pages[page.src_path.replace(os.sep, "/")] = page.url
    return files


def on_post_build(config, **kwargs):
    site_dir = config["site_dir"]

    for page_old, page_new in _redirects.items():
        page_new = str(page_new)
        if page_new.lower().startswith(("http://", "https://")):
            url = page_new
        else:
            path, _, hash_ = page_new.partition("#")
            target = _doc_pages.get(path)
            if target is None:
                log.warning("Redirect target '%s' does not exist!", page_new)
                continue
            url = posixpath.relpath("/" + target, posixpath.dirname("/" + page_old))
            if hash_:
                url += "#" + hash_

        dest = os.path.join(site_dir, page_old)
        os.makedirs(os.path.dirname(dest), exist_ok=True)
        with open(dest, "w", encoding="utf-8") as f:
            f.write(_TEMPLATE.format(url=url))
