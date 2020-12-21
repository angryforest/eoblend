/**
 * Get prefix from request.
 *
 * @param  {Object} req
 * @return {String|undefined}
 */
export function getPrefixFromRequest (req) {
  let prefix = req.url.split('/')[1]
  return prefix
}

/**
 * Get cookie from request.
 *
 * @param  {Object} req
 * @param  {String} key
 * @return {String|undefined}
 */
export function cookieFromRequest (req, key) {
  if (!req.headers.cookie) return
  const cookie = req.headers.cookie.split(';').find(c => c.trim().startsWith(`${key}=`))
  if (cookie) return cookie.split('=')[1]
}

/**
 * Get language from request.
 *
 * @param  {Object} req
 * @return {String|undefined}
 */
export function languageFromRequest (req) {
  if (!req.headers['accept-language']) return
  const language = req.headers['accept-language'].split(';').shift()
  if (language) return language.split(',')[1]
}

/**
 * https://router.vuejs.org/en/advanced/scroll-behavior.html
 */
export function scrollBehavior (to, from, savedPosition) {
  if (savedPosition) return savedPosition

  let position = {}

  if (to.matched.length < 2) {
    position = { x: 0, y: 0 }
  } 
  else if (to.matched.some(r => r.components.default.options.scrollToTop)) {
    position = { x: 0, y: 0 }
  } 
  if (to.hash) {
    position = { selector: to.hash }
  }

  return position
}
