let SessionLoad = 1
if &cp | set nocp | endif
let s:so_save = &so | let s:siso_save = &siso | set so=0 siso=0
let v:this_session=expand("<sfile>:p")
silent only
cd ~/My_Programs/MyPrograms/Webdesign/htdocs/tinderbot
if expand('%') == '' && !&modified && line('$') <= 1 && getline(1) == ''
  let s:wipebuf = bufnr('%')
endif
set shortmess=aoO
badd +43 index.html
badd +0 runbot.php
badd +34 badcookie.php
badd +5 complete.php
badd +0 ~/My_Programs/CirelliTinderbot/app.js
badd +0 ~/My_Programs/CirelliTinderbot/server.js
badd +0 ~/My_Programs/CirelliTinderbot/CirelliTinderBot.js
badd +0 ~/My_Programs/CirelliTinderbot/regex.js
badd +0 ~/My_Programs/CirelliTinderbot/botTask.js
badd +0 ~/My_Programs/CirelliTinderbot/tinder.txt
badd +0 ~/My_Programs/CirelliTinderbot/tinder.js
args index.html
edit runbot.php
set splitbelow splitright
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
let s:l = 7 - ((6 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
7
normal! 0163|
tabedit ~/My_Programs/CirelliTinderbot/server.js
set splitbelow splitright
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
let s:l = 18 - ((14 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
18
normal! 09|
tabedit ~/My_Programs/CirelliTinderbot/CirelliTinderBot.js
set splitbelow splitright
wincmd _ | wincmd |
vsplit
1wincmd h
wincmd w
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
exe 'vert 1resize ' . ((&columns * 108 + 118) / 237)
exe 'vert 2resize ' . ((&columns * 126 + 118) / 237)
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
26,33fold
37,57fold
61,65fold
68,81fold
87,120fold
124,127fold
61
normal! zo
68
normal! zo
87
normal! zo
let s:l = 75 - ((59 * winheight(0) + 25) / 50)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
75
normal! 084|
wincmd w
argglobal
edit ~/My_Programs/CirelliTinderbot/app.js
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
11,19fold
22,28fold
22
normal! zo
let s:l = 10 - ((9 * winheight(0) + 25) / 50)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
10
normal! 027|
wincmd w
exe 'vert 1resize ' . ((&columns * 108 + 118) / 237)
exe 'vert 2resize ' . ((&columns * 126 + 118) / 237)
tabedit ~/My_Programs/CirelliTinderbot/tinder.js
set splitbelow splitright
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
let s:l = 212 - ((26 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
212
normal! 014|
tabedit ~/My_Programs/CirelliTinderbot/tinder.txt
set splitbelow splitright
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
let s:l = 16 - ((15 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
16
normal! 066|
tabedit ~/My_Programs/CirelliTinderbot/botTask.js
set splitbelow splitright
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
15,18fold
13,19fold
26,32fold
36,40fold
43,44fold
47,48fold
51,52fold
55,56fold
59,60fold
63,64fold
67,68fold
82,85fold
25,91fold
98,106fold
110,114fold
117,118fold
121,133fold
136,164fold
167,170fold
173,174fold
177,178fold
97,191fold
198,204fold
208,212fold
215,228fold
231,275fold
279,313fold
316,328fold
331,341fold
344,347fold
350,351fold
197,364fold
13
normal! zo
13
normal! zc
25
normal! zo
25
normal! zc
97
normal! zo
97
normal! zc
197
normal! zo
316
normal! zo
344
normal! zo
350
normal! zo
197
normal! zc
let s:l = 167 - ((147 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
167
normal! 01|
lcd ~/My_Programs/CirelliTinderbot
tabedit ~/My_Programs/MyPrograms/Webdesign/htdocs/tinderbot/index.html
set splitbelow splitright
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
let s:l = 40 - ((18 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
40
normal! 0
tabedit ~/My_Programs/CirelliTinderbot/regex.js
set splitbelow splitright
set nosplitbelow
set nosplitright
wincmd t
set winheight=1 winwidth=1
argglobal
setlocal fdm=manual
setlocal fde=0
setlocal fmr={{{,}}}
setlocal fdi=#
setlocal fdl=0
setlocal fml=1
setlocal fdn=20
setlocal fen
silent! normal! zE
35,74fold
let s:l = 4 - ((0 * winheight(0) + 25) / 51)
if s:l < 1 | let s:l = 1 | endif
exe s:l
normal! zt
4
normal! 039|
tabnext 4
if exists('s:wipebuf')
  silent exe 'bwipe ' . s:wipebuf
endif
unlet! s:wipebuf
set winheight=1 winwidth=20 shortmess=filnxtToO
let s:sx = expand("<sfile>:p:r")."x.vim"
if file_readable(s:sx)
  exe "source " . fnameescape(s:sx)
endif
let &so = s:so_save | let &siso = s:siso_save
doautoall SessionLoadPost
unlet SessionLoad
" vim: set ft=vim :
