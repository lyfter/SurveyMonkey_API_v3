A Survey Monkey API v3 wrapper for PHP
==============================

This Survey Monkey API wrapper makes it eary for PHP developers to do API call to the Survey Monkey API version 3 with optional memory caching.

Survey Monkey API Documentation:
- https://developer.surveymonkey.com/api/v3/

Requirements: 
- App configured at: https://developer.surveymonkey.com/apps/

Implemented calls:
- /v3/users/me
- /v3/surveys
- /v3/surveys/[id]/collectors
- /v3/collectors/[id]/response/bulk
- /v3/collectors/[id]/responses/[id]/details

Unimplemented calls can be called with the call function:
- call($endPoint, $cache = true, $page = false, $perPage = false)