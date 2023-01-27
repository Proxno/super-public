# Frontend
https://animixreplay.to

Some of these files may not be seen/publicly available and may be on - https://beta.animixreplay.to/anime/

Kawa - 
https://animixreplay.to/v3/redo-of-healer-uc-hd/ep6

Gogo -
https://animixreplay.to/v2/high-school-dxd-dub/ep5

Crunchy - 
https://animixreplay.to/v1/mob-psycho-100-dub-english/ep6/s3

PS. I don't care if you think I shouldn't be doing this in PHP and I can give 2 shits if you don't like my coding ways. 

![animixreplay](https://user-images.githubusercontent.com/39221871/212582202-9b14c9f4-a35f-44a0-929f-ccd50696d359.png)
![Animix_watch_3](https://user-images.githubusercontent.com/39221871/212581798-5ebed46c-310e-42fb-84f4-7bd5efa44e08.png)
![AnimixRe](https://user-images.githubusercontent.com/39221871/212582189-9d8bf214-d02a-4f27-8496-023a1497cf7b.png)
![20230109_013110](https://user-images.githubusercontent.com/39221871/212582211-7ea45dcc-1b8d-4e99-8193-63e6a772ac30.gif)

#Todo
Needs Fixing:

HIGH:

- [HIGH PRIORITY] ROLL streams should have hardsubs and locale selection like it had previously.
- [HIGH PRIORITY] All links need to be updated using new link format
- [HIGH PRIORITY] Search (in general but also fix incorrect icons)
- [HIGH PRIORITY] Investigate what's causing long initial loading times - upwards of 30 seconds.
- [HIGH PRIORITY] Have the scraper auto-update ROLL streams
- [HIGH PRIORITY] Stream selection menu when pressing "Change" button and when pressing "Watch" from anime info page
- [HIGH PRIORITY] Currently Airing timetable/Schedule Menu

MEDIUM-HIGH:

- [MEDIUM-HIGH PRIORITY] Some (older) animes on GOGO are using GCP CDNs causing our old friend CORS errors <- Move links to GOFCDN
- [MEDIUM-HIGH PRIORITY] A-Z search (english/jp) names need to be searched at once using slug titles and search needs to work with any part of the name rather than from the first word
- [MEDIUM-HIGH PRIORITY] Proxy deployment on all server regions

MEDIUM:

- [MEDIUM PRIORITY] Anime info page (some of it works but a lot of things don't)
- [MEDIUM PRIORITY] Series link/watch order
- [MEDIUM PRIORITY] "Similar" tab in anime info + op/ed tab + Trailer tab
- [MEDIUM PRIORITY] Fix broken links in anime info tab - AL/AniDB don't work and mangareader.to links not added
- [MEDIUM PRIORITY] Mobile player UI needs changing - Remove Volume bar and add back button + touch anywhere to pause.
- [MEDIUM PRIORITY] Slug titles in search (both english and japanese titles) / search should have one result per season
- [MEDIUM PRIORITY] Next EP button not working on GOGO / Kawa streams
- [MEDIUM PRIORITY] Remove episodes.php and replace with info page
- [MEDIUM PRIORITY] Sub/Dub anime needed to be sorted properly in the homepage tabs
- [MEDIUM PRIORITY] Selecting an anime from the homepage should default to the highest quality source, not GOGO when it's available

LOW:

- [LOW PRIORITY] Clicking image in anime info should load modal popup with alternate cover images
- [LOW PRIORITY] Filter by category / season / year


PART DONE:

- [MEDIUM-HIGH PRIORITY] Homepage with recently released


FULLY DONE:

- [DONE] Remove Kamy for self-hosted API
- [DONE] Sorting out assets, changing size and serving them in WebP
- [DONE] Change GOGO CDN to work around ROW region block.


LATER:

- [HIGH] Accounts
- [HIGH] Swipe left and right menus on mobile for homepage and player


- [MEDIUM PARTIALLY DONE] Track number of eps (watched) / how many there are.
- [MEDIUM] Followed tab on home
- [MEDIUM] Popular tab
- [MEDIUM] Disqus Widget
- [MEDIUM] Genre filtering
- [MEDIUM] Continue watching menu bottom left
- [MEDIUM] Sort out any CSS/JS animations and UI things which differ from original
- [MEDIUM] Episode titles glitching out, e.g. for one piece s1 ep1 the title is "I’m Luffy! The Man Who ." <- what is this
- [MEDIUM] Swipe anywhere on screen to fast-forward / go backward like Netflix / YouTube / original site had this, must just be a PLYR config?


- [LOW] AniList Integration
- [LOW] MAL XML Import feature
- [LOW] Weekly top
- [LOW] Add alternative MangaDex.org links where possible
