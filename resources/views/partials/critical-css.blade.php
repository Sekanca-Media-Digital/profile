{{-- Minimal critical CSS so deferred stylesheets don't cause major FOUC. Hero dimensions prevent CLS (~1.0). --}}
<style>
*,*::before,*::after{box-sizing:border-box}
body{margin:0;font-family:system-ui,-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;font-size-adjust:0.48}
.container{width:100%;max-width:1140px;margin-left:auto;margin-right:auto;padding-left:12px;padding-right:12px}
.navbar{display:flex;flex-wrap:wrap;align-items:center;min-height:56px;padding:.5rem 0}
.navbar-brand{display:inline-flex;align-items:center;text-decoration:none;color:inherit;font-weight:700}
.navbar-collapse{display:flex;flex-grow:1;align-items:center}
.navbar-nav{display:flex;flex-direction:row;list-style:none;margin:0;padding:0;gap:.5rem}
.nav-link{padding:.5rem .75rem;color:inherit;text-decoration:none}
.navbar-toggler{display:none;padding:.25rem .75rem;font-size:1.25rem;border:1px solid transparent;border-radius:.25rem;background:transparent}
.collapse{display:none}
.collapse.show{display:flex}
@media (max-width:991px){
.navbar-toggler{display:inline-block}
.navbar-collapse{flex-basis:100%;flex-direction:column;align-items:flex-start;display:none}
.navbar-collapse.show{display:flex}
}
@media (min-width:992px){
.navbar-collapse{display:flex!important}
}
{{-- Hero: reserve space from first paint to avoid CLS when full CSS loads --}}
.hero,.poseidon-hero{min-height:100vh;display:flex;align-items:center;justify-content:center;text-align:center}
.hero{color:#fff;background:linear-gradient(135deg,rgba(245,160,0,.6),rgba(31,78,107,.5))}
.poseidon-hero{color:#fff;background:linear-gradient(135deg,rgba(13,148,136,.9),rgba(6,182,212,.8))}
{{-- Empire theme above-the-fold --}}
body:not(.poseidon-theme){background:#FFF9ED;scroll-behavior:smooth}
.navbar:not(.poseidon-navbar){background:#fff;box-shadow:0 5px 20px rgba(0,0,0,.05)}
.navbar:not(.poseidon-navbar) .nav-link{color:#1F4E6B;font-weight:500}
{{-- Poseidon theme above-the-fold --}}
body.poseidon-theme{background:#F0FDFA;color:#0F172A;scroll-behavior:smooth}
.poseidon-navbar{background:rgba(13,148,136,.95);box-shadow:0 4px 20px rgba(13,148,136,.2)}
.poseidon-navbar .nav-link{color:rgba(255,255,255,.95)!important;font-weight:500}
</style>
