!(function (e, t) {
    var r = (function (e) {
        var t = {};
        function r(n) {
            if (t[n]) return t[n].exports;
            var i = (t[n] = { i: n, l: !1, exports: {} });
            return e[n].call(i.exports, i, i.exports, r), (i.l = !0), i.exports;
        }
        return (
            (r.m = e),
            (r.c = t),
            (r.d = function (e, t, n) {
                r.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: n });
            }),
            (r.r = function (e) {
                "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 });
            }),
            (r.t = function (e, t) {
                if ((1 & t && (e = r(e)), 8 & t)) return e;
                if (4 & t && "object" == typeof e && e && e.__esModule) return e;
                var n = Object.create(null);
                if ((r.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: e }), 2 & t && "string" != typeof e))
                    for (var i in e)
                        r.d(
                            n,
                            i,
                            function (t) {
                                return e[t];
                            }.bind(null, i)
                        );
                return n;
            }),
            (r.n = function (e) {
                var t =
                    e && e.__esModule
                        ? function () {
                              return e.default;
                          }
                        : function () {
                              return e;
                          };
                return r.d(t, "a", t), t;
            }),
            (r.o = function (e, t) {
                return Object.prototype.hasOwnProperty.call(e, t);
            }),
            (r.p = ""),
            r((r.s = 484))
        );
    })({
        13: function (e, t, r) {
            /*!
FullCalendar Core Package v4.0.2
Docs & License: https://fullcalendar.io/
(c) 2019 Adam Shaw
*/
            !(function (e) {
                "use strict";
                var t = { className: !0, colSpan: !0, rowSpan: !0 },
                    r = { "<tr": "tbody", "<td": "tr" };
                function n(e, r, n) {
                    var i = document.createElement(e);
                    if (r) for (var o in r) "style" === o ? m(i, r[o]) : t[o] ? (i[o] = r[o]) : i.setAttribute(o, r[o]);
                    return "string" == typeof n ? (i.innerHTML = n) : null != n && a(i, n), i;
                }
                function i(e) {
                    e = e.trim();
                    var t = document.createElement(s(e));
                    return (t.innerHTML = e), t.firstChild;
                }
                function o(e) {
                    return Array.prototype.slice.call(
                        (function (e) {
                            e = e.trim();
                            var t = document.createElement(s(e));
                            return (t.innerHTML = e), t.childNodes;
                        })(e)
                    );
                }
                function s(e) {
                    return r[e.substr(0, 3)] || "div";
                }
                function a(e, t) {
                    for (var r = c(t), n = 0; n < r.length; n++) e.appendChild(r[n]);
                }
                function l(e, t) {
                    for (var r = c(t), n = e.firstChild || null, i = 0; i < r.length; i++) e.insertBefore(r[i], n);
                }
                function c(e) {
                    return "string" == typeof e ? o(e) : e instanceof Node ? [e] : Array.prototype.slice.call(e);
                }
                function u(e) {
                    e.parentNode && e.parentNode.removeChild(e);
                }
                var d = Element.prototype.matches || Element.prototype.matchesSelector || Element.prototype.msMatchesSelector,
                    h =
                        Element.prototype.closest ||
                        function (e) {
                            var t = this;
                            if (!document.documentElement.contains(t)) return null;
                            do {
                                if (f(t, e)) return t;
                                t = t.parentElement || t.parentNode;
                            } while (null !== t && 1 === t.nodeType);
                            return null;
                        };
                function p(e, t) {
                    return h.call(e, t);
                }
                function f(e, t) {
                    return d.call(e, t);
                }
                function g(e, t) {
                    for (var r = e instanceof HTMLElement ? [e] : e, n = [], i = 0; i < r.length; i++) for (var o = r[i].querySelectorAll(t), s = 0; s < o.length; s++) n.push(o[s]);
                    return n;
                }
                var v = /(top|left|right|bottom|width|height)$/i;
                function m(e, t) {
                    for (var r in t) y(e, r, t[r]);
                }
                function y(e, t, r) {
                    null == r ? (e.style[t] = "") : "number" == typeof r && v.test(t) ? (e.style[t] = r + "px") : (e.style[t] = r);
                }
                function S(e, t) {
                    var r = { left: Math.max(e.left, t.left), right: Math.min(e.right, t.right), top: Math.max(e.top, t.top), bottom: Math.min(e.bottom, t.bottom) };
                    return r.left < r.right && r.top < r.bottom && r;
                }
                var E = null;
                function b() {
                    return (
                        null === E &&
                            (E = (function () {
                                var e = n("div", { style: { position: "absolute", top: -1e3, left: 0, border: 0, padding: 0, overflow: "scroll", direction: "rtl" } }, "<div></div>");
                                document.body.appendChild(e);
                                var t = e.firstChild.getBoundingClientRect().left > e.getBoundingClientRect().left;
                                return u(e), t;
                            })()),
                        E
                    );
                }
                function D(e) {
                    return (e = Math.max(0, e)), (e = Math.round(e));
                }
                function w(e, t) {
                    void 0 === t && (t = !1);
                    var r = window.getComputedStyle(e),
                        n = parseInt(r.borderLeftWidth, 10) || 0,
                        i = parseInt(r.borderRightWidth, 10) || 0,
                        o = parseInt(r.borderTopWidth, 10) || 0,
                        s = parseInt(r.borderBottomWidth, 10) || 0,
                        a = D(e.offsetWidth - e.clientWidth - n - i),
                        l = D(e.offsetHeight - e.clientHeight - o - s),
                        c = { borderLeft: n, borderRight: i, borderTop: o, borderBottom: s, scrollbarBottom: l, scrollbarLeft: 0, scrollbarRight: 0 };
                    return (
                        b() && "rtl" === r.direction ? (c.scrollbarLeft = a) : (c.scrollbarRight = a),
                        t &&
                            ((c.paddingLeft = parseInt(r.paddingLeft, 10) || 0),
                            (c.paddingRight = parseInt(r.paddingRight, 10) || 0),
                            (c.paddingTop = parseInt(r.paddingTop, 10) || 0),
                            (c.paddingBottom = parseInt(r.paddingBottom, 10) || 0)),
                        c
                    );
                }
                function T(e, t) {
                    void 0 === t && (t = !1);
                    var r = C(e),
                        n = w(e, t),
                        i = { left: r.left + n.borderLeft + n.scrollbarLeft, right: r.right - n.borderRight - n.scrollbarRight, top: r.top + n.borderTop, bottom: r.bottom - n.borderBottom - n.scrollbarBottom };
                    return t && ((i.left += n.paddingLeft), (i.right -= n.paddingRight), (i.top += n.paddingTop), (i.bottom -= n.paddingBottom)), i;
                }
                function C(e) {
                    var t = e.getBoundingClientRect();
                    return { left: t.left + window.pageXOffset, top: t.top + window.pageYOffset, right: t.right + window.pageXOffset, bottom: t.bottom + window.pageYOffset };
                }
                function R(e) {
                    var t = window.getComputedStyle(e);
                    return e.getBoundingClientRect().height + parseInt(t.marginTop, 10) + parseInt(t.marginBottom, 10);
                }
                function I(e) {
                    for (var t = []; e instanceof HTMLElement; ) {
                        var r = window.getComputedStyle(e);
                        if ("fixed" === r.position) break;
                        /(auto|scroll)/.test(r.overflow + r.overflowY + r.overflowX) && t.push(e), (e = e.parentNode);
                    }
                    return t;
                }
                function M(e) {
                    e.preventDefault();
                }
                function P(e, t, r, n) {
                    function i(e) {
                        var t = p(e.target, r);
                        t && n.call(t, e, t);
                    }
                    return (
                        e.addEventListener(t, i),
                        function () {
                            e.removeEventListener(t, i);
                        }
                    );
                }
                var H = ["webkitTransitionEnd", "otransitionend", "oTransitionEnd", "msTransitionEnd", "transitionend"],
                    k = ["sun", "mon", "tue", "wed", "thu", "fri", "sat"];
                function _(e, t) {
                    var r = F(e);
                    return (r[2] += t), G(r);
                }
                function x(e, t) {
                    var r = F(e);
                    return (r[6] += t), G(r);
                }
                function O(e, t) {
                    return (t.valueOf() - e.valueOf()) / 864e5;
                }
                function z(e, t) {
                    var r = A(e),
                        n = A(t);
                    return { years: 0, months: 0, days: Math.round(O(r, n)), milliseconds: t.valueOf() - n.valueOf() - (e.valueOf() - r.valueOf()) };
                }
                function L(e, t) {
                    var r = N(e, t);
                    return null !== r && r % 7 == 0 ? r / 7 : null;
                }
                function N(e, t) {
                    return Y(e) === Y(t) ? Math.round(O(e, t)) : null;
                }
                function A(e) {
                    return G([e.getUTCFullYear(), e.getUTCMonth(), e.getUTCDate()]);
                }
                function B(e, t, r, n) {
                    var i = G([t, 0, 1 + V(t, r, n)]),
                        o = A(e),
                        s = Math.round(O(i, o));
                    return Math.floor(s / 7) + 1;
                }
                function V(e, t, r) {
                    var n = 7 + t - r,
                        i = (7 + G([e, 0, n]).getUTCDay() - t) % 7;
                    return -i + n - 1;
                }
                function U(e) {
                    return [e.getFullYear(), e.getMonth(), e.getDate(), e.getHours(), e.getMinutes(), e.getSeconds(), e.getMilliseconds()];
                }
                function W(e) {
                    return new Date(e[0], e[1] || 0, null == e[2] ? 1 : e[2], e[3] || 0, e[4] || 0, e[5] || 0);
                }
                function F(e) {
                    return [e.getUTCFullYear(), e.getUTCMonth(), e.getUTCDate(), e.getUTCHours(), e.getUTCMinutes(), e.getUTCSeconds(), e.getUTCMilliseconds()];
                }
                function G(e) {
                    return 1 === e.length && (e = e.concat([0])), new Date(Date.UTC.apply(Date, e));
                }
                function j(e) {
                    return !isNaN(e.valueOf());
                }
                function Y(e) {
                    return 1e3 * e.getUTCHours() * 60 * 60 + 1e3 * e.getUTCMinutes() * 60 + 1e3 * e.getUTCSeconds() + e.getUTCMilliseconds();
                }
                var q = ["years", "months", "days", "milliseconds"],
                    Z = /^(-?)(?:(\d+)\.)?(\d+):(\d\d)(?::(\d\d)(?:\.(\d\d\d))?)?/;
                function X(e, t) {
                    var r;
                    return "string" == typeof e
                        ? (function (e) {
                              var t = Z.exec(e);
                              if (t) {
                                  var r = t[1] ? -1 : 1;
                                  return {
                                      years: 0,
                                      months: 0,
                                      days: r * (t[2] ? parseInt(t[2], 10) : 0),
                                      milliseconds: r * (60 * (t[3] ? parseInt(t[3], 10) : 0) * 60 * 1e3 + 60 * (t[4] ? parseInt(t[4], 10) : 0) * 1e3 + 1e3 * (t[5] ? parseInt(t[5], 10) : 0) + (t[6] ? parseInt(t[6], 10) : 0)),
                                  };
                              }
                              return null;
                          })(e)
                        : "object" == typeof e && e
                        ? J(e)
                        : "number" == typeof e
                        ? J((((r = {})[t || "milliseconds"] = e), r))
                        : null;
                }
                function J(e) {
                    return {
                        years: e.years || e.year || 0,
                        months: e.months || e.month || 0,
                        days: (e.days || e.day || 0) + 7 * K(e),
                        milliseconds: 60 * (e.hours || e.hour || 0) * 60 * 1e3 + 60 * (e.minutes || e.minute || 0) * 1e3 + 1e3 * (e.seconds || e.second || 0) + (e.milliseconds || e.millisecond || e.ms || 0),
                    };
                }
                function K(e) {
                    return e.weeks || e.week || 0;
                }
                function Q(e, t) {
                    return e.years === t.years && e.months === t.months && e.days === t.days && e.milliseconds === t.milliseconds;
                }
                function $(e, t) {
                    return { years: e.years - t.years, months: e.months - t.months, days: e.days - t.days, milliseconds: e.milliseconds - t.milliseconds };
                }
                function ee(e) {
                    return te(e) / 864e5;
                }
                function te(e) {
                    return 31536e6 * e.years + 2592e6 * e.months + 864e5 * e.days + e.milliseconds;
                }
                function re(e, t) {
                    var r = e.milliseconds;
                    if (r) {
                        if (r % 1e3 != 0) return { unit: "millisecond", value: r };
                        if (r % 6e4 != 0) return { unit: "second", value: r / 1e3 };
                        if (r % 36e5 != 0) return { unit: "minute", value: r / 6e4 };
                        if (r) return { unit: "hour", value: r / 36e5 };
                    }
                    return e.days
                        ? t || e.days % 7 != 0
                            ? { unit: "day", value: e.days }
                            : { unit: "week", value: e.days / 7 }
                        : e.months
                        ? { unit: "month", value: e.months }
                        : e.years
                        ? { unit: "year", value: e.years }
                        : { unit: "millisecond", value: 0 };
                }
                function ne(e) {
                    e.forEach(function (e) {
                        e.style.height = "";
                    });
                }
                function ie(e) {
                    var t,
                        r,
                        n = [],
                        i = [];
                    for ("string" == typeof e ? (i = e.split(/\s*,\s*/)) : "function" == typeof e ? (i = [e]) : Array.isArray(e) && (i = e), t = 0; t < i.length; t++)
                        "string" == typeof (r = i[t]) ? n.push("-" === r.charAt(0) ? { field: r.substring(1), order: -1 } : { field: r, order: 1 }) : "function" == typeof r && n.push({ func: r });
                    return n;
                }
                function oe(e, t, r) {
                    var n, i;
                    for (n = 0; n < r.length; n++) if ((i = se(e, t, r[n]))) return i;
                    return 0;
                }
                function se(e, t, r) {
                    return r.func ? r.func(e, t) : ae(e[r.field], t[r.field]) * (r.order || 1);
                }
                function ae(e, t) {
                    return e || t ? (null == t ? -1 : null == e ? 1 : "string" == typeof e || "string" == typeof t ? String(e).localeCompare(String(t)) : e - t) : 0;
                }
                function le(e) {
                    return e.charAt(0).toUpperCase() + e.slice(1);
                }
                function ce(e, t) {
                    var r = String(e);
                    return "000".substr(0, t - r.length) + r;
                }
                function ue(e) {
                    return e % 1 == 0;
                }
                function de(e, t, r) {
                    if (("function" == typeof e && (e = [e]), e)) {
                        var n = void 0,
                            i = void 0;
                        for (n = 0; n < e.length; n++) i = e[n].apply(t, r) || i;
                        return i;
                    }
                }
                function he() {
                    for (var e = [], t = 0; t < arguments.length; t++) e[t] = arguments[t];
                    for (var r = 0; r < e.length; r++) if (void 0 !== e[r]) return e[r];
                }
                function pe(e, t) {
                    var r,
                        n,
                        i,
                        o,
                        s,
                        a = function () {
                            var l = new Date().valueOf() - o;
                            l < t ? (r = setTimeout(a, t - l)) : ((r = null), (s = e.apply(i, n)), (i = n = null));
                        };
                    return function () {
                        return (i = this), (n = arguments), (o = new Date().valueOf()), r || (r = setTimeout(a, t)), s;
                    };
                }
                function fe(e, t, r, n) {
                    void 0 === r && (r = {});
                    var i = {};
                    for (var o in t) {
                        var s = t[o];
                        void 0 !== e[o]
                            ? s === Function
                                ? (i[o] = "function" == typeof e[o] ? e[o] : null)
                                : (i[o] = s ? s(e[o]) : e[o])
                            : void 0 !== r[o]
                            ? (i[o] = r[o])
                            : s === String
                            ? (i[o] = "")
                            : s && s !== Number && s !== Boolean && s !== Function
                            ? (i[o] = s(null))
                            : (i[o] = null);
                    }
                    if (n) for (var o in e) void 0 === t[o] && (n[o] = e[o]);
                    return i;
                }
                function ge(e) {
                    return Array.isArray(e) ? Array.prototype.slice.call(e) : e;
                }
                function ve(e) {
                    var t = Math.floor(O(e.start, e.end)) || 1,
                        r = A(e.start),
                        n = _(r, t);
                    return { start: r, end: n };
                }
                function me(e, t) {
                    void 0 === t && (t = X(0));
                    var r = null,
                        n = null;
                    if (e.end) {
                        n = A(e.end);
                        var i = e.end.valueOf() - n.valueOf();
                        i && i >= te(t) && (n = _(n, 1));
                    }
                    return e.start && ((r = A(e.start)), n && n <= r && (n = _(r, 1))), { start: r, end: n };
                }
                function ye(e, t, r, n) {
                    return "year" === n ? X(r.diffWholeYears(e, t), "year") : "month" === n ? X(r.diffWholeMonths(e, t), "month") : z(e, t);
                }
                /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */ var Se = function (
                    e,
                    t
                ) {
                    return (Se =
                        Object.setPrototypeOf ||
                        ({ __proto__: [] } instanceof Array &&
                            function (e, t) {
                                e.__proto__ = t;
                            }) ||
                        function (e, t) {
                            for (var r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                        })(e, t);
                };
                function Ee(e, t) {
                    function r() {
                        this.constructor = e;
                    }
                    Se(e, t), (e.prototype = null === t ? Object.create(t) : ((r.prototype = t.prototype), new r()));
                }
                var be = function () {
                    return (be =
                        Object.assign ||
                        function (e) {
                            for (var t, r = 1, n = arguments.length; r < n; r++) for (var i in (t = arguments[r])) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
                            return e;
                        }).apply(this, arguments);
                };
                function De(e, t, r, n) {
                    var i = n[e.recurringDef.typeId],
                        o = i.expand(e.recurringDef.typeData, t, r);
                    return e.allDay && (o = o.map(A)), o;
                }
                function we(e, t) {
                    var r,
                        n,
                        i,
                        o,
                        s,
                        a,
                        l = {};
                    if (t)
                        for (r = 0; r < t.length; r++) {
                            for (n = t[r], i = [], o = e.length - 1; o >= 0; o--)
                                if ("object" == typeof (s = e[o][n]) && s) i.unshift(s);
                                else if (void 0 !== s) {
                                    l[n] = s;
                                    break;
                                }
                            i.length && (l[n] = we(i));
                        }
                    for (r = e.length - 1; r >= 0; r--) for (n in (a = e[r])) n in l || (l[n] = a[n]);
                    return l;
                }
                function Te(e, t) {
                    var r = {};
                    for (var n in e) t(e[n], n) && (r[n] = e[n]);
                    return r;
                }
                function Ce(e, t) {
                    var r = {};
                    for (var n in e) r[n] = t(e[n], n);
                    return r;
                }
                function Re(e) {
                    for (var t = {}, r = 0, n = e; r < n.length; r++) {
                        var i = n[r];
                        t[i] = !0;
                    }
                    return t;
                }
                function Ie(e) {
                    var t = [];
                    for (var r in e) t.push(e[r]);
                    return t;
                }
                function Me(e, t, r, n) {
                    for (var i = { defs: {}, instances: {} }, o = 0, s = e; o < s.length; o++) {
                        var a = s[o],
                            l = Ut(a, t, r, n);
                        l && Pe(l, i);
                    }
                    return i;
                }
                function Pe(e, t) {
                    return void 0 === t && (t = { defs: {}, instances: {} }), (t.defs[e.def.defId] = e.def), e.instance && (t.instances[e.instance.instanceId] = e.instance), t;
                }
                function He(e, t, r) {
                    var n = r.dateEnv,
                        i = e.defs,
                        o = e.instances;
                    for (var s in ((o = Te(o, function (e) {
                        return !i[e.defId].recurringDef;
                    })),
                    i)) {
                        var a = i[s];
                        if (a.recurringDef) {
                            var l = De(a, t, r.dateEnv, r.pluginSystem.hooks.recurringTypes),
                                c = a.recurringDef.duration;
                            c || (c = a.allDay ? r.defaultAllDayEventDuration : r.defaultTimedEventDuration);
                            for (var u = 0, d = l; u < d.length; u++) {
                                var h = d[u],
                                    p = Ft(s, { start: h, end: n.add(h, c) });
                                o[p.instanceId] = p;
                            }
                        }
                    }
                    return { defs: i, instances: o };
                }
                function ke(e, t) {
                    var r = e.instances[t];
                    if (r) {
                        var n = e.defs[r.defId],
                            i = ze(e, function (e) {
                                return (t = n), (r = e), Boolean(t.groupId && t.groupId === r.groupId);
                                var t, r;
                            });
                        return (i.defs[n.defId] = n), (i.instances[r.instanceId] = r), i;
                    }
                    return { defs: {}, instances: {} };
                }
                function _e(e, t) {
                    var r;
                    if (t) {
                        r = [];
                        for (var n = 0, i = e; n < i.length; n++) {
                            var o = i[n],
                                s = t(o);
                            s ? r.push(s) : null == s && r.push(o);
                        }
                    } else r = e;
                    return r;
                }
                function xe() {
                    return { defs: {}, instances: {} };
                }
                function Oe(e, t) {
                    return { defs: be({}, e.defs, t.defs), instances: be({}, e.instances, t.instances) };
                }
                function ze(e, t) {
                    var r = Te(e.defs, t),
                        n = Te(e.instances, function (e) {
                            return r[e.defId];
                        });
                    return { defs: r, instances: n };
                }
                function Le(e, t) {
                    var r,
                        n,
                        i = [],
                        o = t.start;
                    for (e.sort(Ne), r = 0; r < e.length; r++) (n = e[r]).start > o && i.push({ start: o, end: n.start }), n.end > o && (o = n.end);
                    return o < t.end && i.push({ start: o, end: t.end }), i;
                }
                function Ne(e, t) {
                    return e.start.valueOf() - t.start.valueOf();
                }
                function Ae(e, t) {
                    var r = e.start,
                        n = e.end,
                        i = null;
                    return (
                        null !== t.start && (r = null === r ? t.start : new Date(Math.max(r.valueOf(), t.start.valueOf()))),
                        null != t.end && (n = null === n ? t.end : new Date(Math.min(n.valueOf(), t.end.valueOf()))),
                        (null === r || null === n || r < n) && (i = { start: r, end: n }),
                        i
                    );
                }
                function Be(e, t) {
                    return (null === e.start ? null : e.start.valueOf()) === (null === t.start ? null : t.start.valueOf()) && (null === e.end ? null : e.end.valueOf()) === (null === t.end ? null : t.end.valueOf());
                }
                function Ve(e, t) {
                    return (null === e.end || null === t.start || e.end > t.start) && (null === e.start || null === t.end || e.start < t.end);
                }
                function Ue(e, t) {
                    return (null === e.start || (null !== t.start && t.start >= e.start)) && (null === e.end || (null !== t.end && t.end <= e.end));
                }
                function We(e, t) {
                    return (null === e.start || t >= e.start) && (null === e.end || t < e.end);
                }
                function Fe(e, t) {
                    var r,
                        n = e.length;
                    if (n !== t.length) return !1;
                    for (r = 0; r < n; r++) if (e[r] !== t[r]) return !1;
                    return !0;
                }
                function Ge(e) {
                    var t, r;
                    return function () {
                        return (t && Fe(t, arguments)) || ((t = arguments), (r = e.apply(this, arguments))), r;
                    };
                }
                function je(e, t) {
                    var r = null;
                    return function () {
                        var n = e.apply(this, arguments);
                        return (null === r || (r !== n && !t(r, n))) && (r = n), r;
                    };
                }
                var Ye = { week: 3, separator: 0, omitZeroMinute: 0, meridiem: 0, omitCommas: 0 },
                    qe = { timeZoneName: 7, era: 6, year: 5, month: 4, day: 2, weekday: 2, hour: 1, minute: 1, second: 1 },
                    Ze = /\s*([ap])\.?m\.?/i,
                    Xe = /,/g,
                    Je = /\s+/g,
                    Ke = /\u200e/g,
                    Qe = /UTC|GMT/,
                    $e = (function () {
                        function e(e) {
                            var t = {},
                                r = {},
                                n = 0;
                            for (var i in e) i in Ye ? ((r[i] = e[i]), (n = Math.max(Ye[i], n))) : ((t[i] = e[i]), i in qe && (n = Math.max(qe[i], n)));
                            (this.standardDateProps = t), (this.extendedSettings = r), (this.severity = n), (this.buildFormattingFunc = Ge(et));
                        }
                        return (
                            (e.prototype.format = function (e, t) {
                                return this.buildFormattingFunc(this.standardDateProps, this.extendedSettings, t)(e);
                            }),
                            (e.prototype.formatRange = function (e, t, r) {
                                var n,
                                    i,
                                    o,
                                    s = this.standardDateProps,
                                    a = this.extendedSettings,
                                    l =
                                        ((n = e.marker),
                                        (i = t.marker),
                                        (o = r.calendarSystem).getMarkerYear(n) !== o.getMarkerYear(i) ? 5 : o.getMarkerMonth(n) !== o.getMarkerMonth(i) ? 4 : o.getMarkerDay(n) !== o.getMarkerDay(i) ? 2 : Y(n) !== Y(i) ? 1 : 0);
                                if (!l) return this.format(e, r);
                                var c = l;
                                !(c > 1) || ("numeric" !== s.year && "2-digit" !== s.year) || ("numeric" !== s.month && "2-digit" !== s.month) || ("numeric" !== s.day && "2-digit" !== s.day) || (c = 1);
                                var u = this.format(e, r),
                                    d = this.format(t, r);
                                if (u === d) return u;
                                var h = (function (e, t) {
                                        var r = {};
                                        for (var n in e) (n in qe && !(qe[n] <= t)) || (r[n] = e[n]);
                                        return r;
                                    })(s, c),
                                    p = et(h, a, r),
                                    f = p(e),
                                    g = p(t),
                                    v = (function (e, t, r, n) {
                                        for (var i = 0; i < e.length; ) {
                                            var o = e.indexOf(t, i);
                                            if (-1 === o) break;
                                            var s = e.substr(0, o);
                                            i = o + t.length;
                                            for (var a = e.substr(i), l = 0; l < r.length; ) {
                                                var c = r.indexOf(n, l);
                                                if (-1 === c) break;
                                                var u = r.substr(0, c);
                                                l = c + n.length;
                                                var d = r.substr(l);
                                                if (s === u && a === d) return { before: s, after: a };
                                            }
                                        }
                                        return null;
                                    })(u, f, d, g),
                                    m = a.separator || "";
                                return v ? v.before + f + m + g + v.after : u + m + d;
                            }),
                            (e.prototype.getLargestUnit = function () {
                                switch (this.severity) {
                                    case 7:
                                    case 6:
                                    case 5:
                                        return "year";
                                    case 4:
                                        return "month";
                                    case 3:
                                        return "week";
                                    default:
                                        return "day";
                                }
                            }),
                            e
                        );
                    })();
                function et(e, t, r) {
                    var n = Object.keys(e).length;
                    return 1 === n && "short" === e.timeZoneName
                        ? function (e) {
                              return it(e.timeZoneOffset);
                          }
                        : 0 === n && t.week
                        ? function (e) {
                              return (
                                  (n = r.computeWeekNumber(e.marker)),
                                  (i = r.weekLabel),
                                  (o = r.locale),
                                  (s = t.week),
                                  (a = []),
                                  "narrow" === s ? a.push(i) : "short" === s && a.push(i, " "),
                                  a.push(o.simpleNumberFormat.format(n)),
                                  o.options.isRtl && a.reverse(),
                                  a.join("")
                              );
                              var n, i, o, s, a;
                          }
                        : (function (e, t, r) {
                              (e = be({}, e)),
                                  (t = be({}, t)),
                                  (function (e, t) {
                                      e.timeZoneName && (e.hour || (e.hour = "2-digit"), e.minute || (e.minute = "2-digit")),
                                          "long" === e.timeZoneName && (e.timeZoneName = "short"),
                                          t.omitZeroMinute && (e.second || e.millisecond) && delete t.omitZeroMinute;
                                  })(e, t),
                                  (e.timeZone = "UTC");
                              var n,
                                  i = new Intl.DateTimeFormat(r.locale.codes, e);
                              if (t.omitZeroMinute) {
                                  var o = be({}, e);
                                  delete o.minute, (n = new Intl.DateTimeFormat(r.locale.codes, o));
                              }
                              return function (o) {
                                  var s = o.marker,
                                      a = (n && !s.getUTCMinutes() ? n : i).format(s);
                                  return (function (e, t, r, n, i) {
                                      return (
                                          (e = e.replace(Ke, "")),
                                          "short" === r.timeZoneName &&
                                              (e = (function (e, t) {
                                                  var r = !1;
                                                  return (
                                                      (e = e.replace(Qe, function () {
                                                          return (r = !0), t;
                                                      })),
                                                      r || (e += " " + t),
                                                      e
                                                  );
                                              })(e, "UTC" === i.timeZone || null == t.timeZoneOffset ? "UTC" : it(t.timeZoneOffset))),
                                          n.omitCommas && (e = e.replace(Xe, "").trim()),
                                          n.omitZeroMinute && (e = e.replace(":00", "")),
                                          !1 === n.meridiem
                                              ? (e = e.replace(Ze, "").trim())
                                              : "narrow" === n.meridiem
                                              ? (e = e.replace(Ze, function (e, t) {
                                                    return t.toLocaleLowerCase();
                                                }))
                                              : "short" === n.meridiem
                                              ? (e = e.replace(Ze, function (e, t) {
                                                    return t.toLocaleLowerCase() + "m";
                                                }))
                                              : "lowercase" === n.meridiem &&
                                                (e = e.replace(Ze, function (e) {
                                                    return e.toLocaleLowerCase();
                                                })),
                                          (e = (e = e.replace(Je, " ")).trim())
                                      );
                                  })(a, o, e, t, r);
                              };
                          })(e, t, r);
                }
                var tt = (function () {
                        function e(e, t) {
                            (this.cmdStr = e), (this.separator = t);
                        }
                        return (
                            (e.prototype.format = function (e, t) {
                                return t.cmdFormatter(this.cmdStr, ot(e, null, t, this.separator));
                            }),
                            (e.prototype.formatRange = function (e, t, r) {
                                return r.cmdFormatter(this.cmdStr, ot(e, t, r, this.separator));
                            }),
                            e
                        );
                    })(),
                    rt = (function () {
                        function e(e) {
                            this.func = e;
                        }
                        return (
                            (e.prototype.format = function (e, t) {
                                return this.func(ot(e, null, t));
                            }),
                            (e.prototype.formatRange = function (e, t, r) {
                                return this.func(ot(e, t, r));
                            }),
                            e
                        );
                    })();
                function nt(e, t) {
                    return "object" == typeof e && e ? ("string" == typeof t && (e = be({ separator: t }, e)), new $e(e)) : "string" == typeof e ? new tt(e, t) : "function" == typeof e ? new rt(e) : void 0;
                }
                function it(e, t) {
                    void 0 === t && (t = !1);
                    var r = e < 0 ? "-" : "+",
                        n = Math.abs(e),
                        i = Math.floor(n / 60),
                        o = Math.round(n % 60);
                    return t ? r + ce(i, 2) + ":" + ce(o, 2) : "GMT" + r + i + (o ? ":" + ce(o, 2) : "");
                }
                function ot(e, t, r, n) {
                    var i = st(e, r.calendarSystem),
                        o = t ? st(t, r.calendarSystem) : null;
                    return { date: i, start: i, end: o, timeZone: r.timeZone, localeCodes: r.locale.codes, separator: n };
                }
                function st(e, t) {
                    var r = t.markerToArray(e.marker);
                    return { marker: e.marker, timeZoneOffset: e.timeZoneOffset, array: r, year: r[0], month: r[1], day: r[2], hour: r[3], minute: r[4], second: r[5], millisecond: r[6] };
                }
                var at = (function () {
                        function e(e, t) {
                            (this.calendar = e), (this.internalEventSource = t);
                        }
                        return (
                            (e.prototype.remove = function () {
                                this.calendar.dispatch({ type: "REMOVE_EVENT_SOURCE", sourceId: this.internalEventSource.sourceId });
                            }),
                            (e.prototype.refetch = function () {
                                this.calendar.dispatch({ type: "FETCH_EVENT_SOURCES", sourceIds: [this.internalEventSource.sourceId] });
                            }),
                            Object.defineProperty(e.prototype, "id", {
                                get: function () {
                                    return this.internalEventSource.publicId;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "url", {
                                get: function () {
                                    return this.internalEventSource.meta.url;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            e
                        );
                    })(),
                    lt = (function () {
                        function e(e, t, r) {
                            (this._calendar = e), (this._def = t), (this._instance = r || null);
                        }
                        return (
                            (e.prototype.setProp = function (e, t) {
                                var r, n;
                                if (e in Bt);
                                else if (e in At) "function" == typeof At[e] && (t = At[e](t)), this.mutate({ standardProps: ((r = {}), (r[e] = t), r) });
                                else if (e in _t) {
                                    var i = void 0;
                                    "function" == typeof _t[e] && (t = _t[e](t)),
                                        "color" === e ? (i = { backgroundColor: t, borderColor: t }) : "editable" === e ? (i = { startEditable: t, durationEditable: t }) : (((n = {})[e] = t), (i = n)),
                                        this.mutate({ standardProps: { ui: i } });
                                }
                            }),
                            (e.prototype.setExtendedProp = function (e, t) {
                                var r;
                                this.mutate({ extendedProps: ((r = {}), (r[e] = t), r) });
                            }),
                            (e.prototype.setStart = function (e, t) {
                                void 0 === t && (t = {});
                                var r = this._calendar.dateEnv,
                                    n = r.createMarker(e);
                                if (n && this._instance) {
                                    var i = this._instance.range,
                                        o = ye(i.start, n, r, t.granularity),
                                        s = null;
                                    if (t.maintainDuration) {
                                        var a = ye(i.start, i.end, r, t.granularity),
                                            l = ye(n, i.end, r, t.granularity);
                                        s = $(a, l);
                                    }
                                    this.mutate({ startDelta: o, endDelta: s });
                                }
                            }),
                            (e.prototype.setEnd = function (e, t) {
                                void 0 === t && (t = {});
                                var r,
                                    n = this._calendar.dateEnv;
                                if ((null == e || (r = n.createMarker(e))) && this._instance)
                                    if (r) {
                                        var i = ye(this._instance.range.end, r, n, t.granularity);
                                        this.mutate({ endDelta: i });
                                    } else this.mutate({ standardProps: { hasEnd: !1 } });
                            }),
                            (e.prototype.setDates = function (e, t, r) {
                                void 0 === r && (r = {});
                                var n,
                                    i = this._calendar.dateEnv,
                                    o = { allDay: r.allDay },
                                    s = i.createMarker(e);
                                if (s && (null == t || (n = i.createMarker(t))) && this._instance) {
                                    var a = this._instance.range;
                                    !0 === r.allDay && (a = ve(a));
                                    var l = ye(a.start, s, i, r.granularity);
                                    if (n) {
                                        var c = ye(a.end, n, i, r.granularity);
                                        this.mutate({ startDelta: l, endDelta: c, standardProps: o });
                                    } else (o.hasEnd = !1), this.mutate({ startDelta: l, standardProps: o });
                                }
                            }),
                            (e.prototype.moveStart = function (e) {
                                var t = X(e);
                                t && this.mutate({ startDelta: t });
                            }),
                            (e.prototype.moveEnd = function (e) {
                                var t = X(e);
                                t && this.mutate({ endDelta: t });
                            }),
                            (e.prototype.moveDates = function (e) {
                                var t = X(e);
                                t && this.mutate({ startDelta: t, endDelta: t });
                            }),
                            (e.prototype.setAllDay = function (e, t) {
                                void 0 === t && (t = {});
                                var r = { allDay: e },
                                    n = t.maintainDuration;
                                null == n && (n = this._calendar.opt("allDayMaintainDuration")), this._def.allDay !== e && (r.hasEnd = n), this.mutate({ standardProps: r });
                            }),
                            (e.prototype.formatRange = function (e) {
                                var t = this._calendar.dateEnv,
                                    r = this._instance,
                                    n = nt(e, this._calendar.opt("defaultRangeSeparator"));
                                return this._def.hasEnd ? t.formatRange(r.range.start, r.range.end, n, { forcedStartTzo: r.forcedStartTzo, forcedEndTzo: r.forcedEndTzo }) : t.format(r.range.start, n, { forcedTzo: r.forcedStartTzo });
                            }),
                            (e.prototype.mutate = function (e) {
                                var t = this._def,
                                    r = this._instance;
                                if (r) {
                                    this._calendar.dispatch({ type: "MUTATE_EVENTS", instanceId: r.instanceId, mutation: e, fromApi: !0 });
                                    var n = this._calendar.state.eventStore;
                                    (this._def = n.defs[t.defId]), (this._instance = n.instances[r.instanceId]);
                                }
                            }),
                            (e.prototype.remove = function () {
                                this._calendar.dispatch({ type: "REMOVE_EVENT_DEF", defId: this._def.defId });
                            }),
                            Object.defineProperty(e.prototype, "source", {
                                get: function () {
                                    var e = this._def.sourceId;
                                    return e ? new at(this._calendar, this._calendar.state.eventSources[e]) : null;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "start", {
                                get: function () {
                                    return this._instance ? this._calendar.dateEnv.toDate(this._instance.range.start) : null;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "end", {
                                get: function () {
                                    return this._instance && this._def.hasEnd ? this._calendar.dateEnv.toDate(this._instance.range.end) : null;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "id", {
                                get: function () {
                                    return this._def.publicId;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "groupId", {
                                get: function () {
                                    return this._def.groupId;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "allDay", {
                                get: function () {
                                    return this._def.allDay;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "title", {
                                get: function () {
                                    return this._def.title;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "url", {
                                get: function () {
                                    return this._def.url;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "rendering", {
                                get: function () {
                                    return this._def.rendering;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "startEditable", {
                                get: function () {
                                    return this._def.ui.startEditable;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "durationEditable", {
                                get: function () {
                                    return this._def.ui.durationEditable;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "constraint", {
                                get: function () {
                                    return this._def.ui.constraints[0] || null;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "overlap", {
                                get: function () {
                                    return this._def.ui.overlap;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "allow", {
                                get: function () {
                                    return this._def.ui.allows[0] || null;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "backgroundColor", {
                                get: function () {
                                    return this._def.ui.backgroundColor;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "borderColor", {
                                get: function () {
                                    return this._def.ui.borderColor;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "textColor", {
                                get: function () {
                                    return this._def.ui.textColor;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "classNames", {
                                get: function () {
                                    return this._def.ui.classNames;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            Object.defineProperty(e.prototype, "extendedProps", {
                                get: function () {
                                    return this._def.extendedProps;
                                },
                                enumerable: !0,
                                configurable: !0,
                            }),
                            e
                        );
                    })();
                function ct(e, t, r, n) {
                    var i = {},
                        o = {},
                        s = {},
                        a = [],
                        l = [],
                        c = pt(e.defs, t);
                    for (var u in e.defs) {
                        var d = e.defs[u];
                        "inverse-background" === d.rendering && (d.groupId ? ((i[d.groupId] = []), s[d.groupId] || (s[d.groupId] = d)) : (o[u] = []));
                    }
                    for (var h in e.instances) {
                        var p = e.instances[h],
                            d = e.defs[p.defId],
                            f = c[d.defId],
                            g = p.range,
                            v = !d.allDay && n ? me(g, n) : g,
                            m = Ae(v, r);
                        m &&
                            ("inverse-background" === d.rendering
                                ? d.groupId
                                    ? i[d.groupId].push(m)
                                    : o[p.defId].push(m)
                                : ("background" === d.rendering ? a : l).push({ def: d, ui: f, instance: p, range: m, isStart: v.start && v.start.valueOf() === m.start.valueOf(), isEnd: v.end && v.end.valueOf() === m.end.valueOf() }));
                    }
                    for (var y in i)
                        for (var S = i[y], E = Le(S, r), b = 0, D = E; b < D.length; b++) {
                            var w = D[b],
                                d = s[y],
                                f = c[d.defId];
                            a.push({ def: d, ui: f, instance: null, range: w, isStart: !1, isEnd: !1 });
                        }
                    for (var u in o)
                        for (var S = o[u], E = Le(S, r), T = 0, C = E; T < C.length; T++) {
                            var w = C[T];
                            a.push({ def: e.defs[u], ui: c[u], instance: null, range: w, isStart: !1, isEnd: !1 });
                        }
                    return { bg: a, fg: l };
                }
                function ut(e, t, r) {
                    e.hasPublicHandlers("eventRender") &&
                        (t = t.filter(function (t) {
                            var n = e.publiclyTrigger("eventRender", [{ event: new lt(e.calendar, t.eventRange.def, t.eventRange.instance), isMirror: r, isStart: t.isStart, isEnd: t.isEnd, el: t.el, view: e }]);
                            return !1 !== n && (n && !0 !== n && (t.el = n), !0);
                        }));
                    for (var n = 0, i = t; n < i.length; n++) {
                        var o = i[n];
                        dt(o.el, o);
                    }
                    return t;
                }
                function dt(e, t) {
                    e.fcSeg = t;
                }
                function ht(e) {
                    return e.fcSeg || null;
                }
                function pt(e, t) {
                    return Ce(e, function (e) {
                        return ft(e, t);
                    });
                }
                function ft(e, t) {
                    var r = [];
                    return t[""] && r.push(t[""]), t[e.defId] && r.push(t[e.defId]), r.push(e.ui), Lt(r);
                }
                function gt(e, t, r, n) {
                    var i = pt(e.defs, t),
                        o = { defs: {}, instances: {} };
                    for (var s in e.defs) {
                        var a = e.defs[s];
                        o.defs[s] = vt(a, i[s], r, n.pluginSystem.hooks.eventDefMutationAppliers, n);
                    }
                    for (var l in e.instances) {
                        var c = e.instances[l],
                            a = o.defs[c.defId];
                        o.instances[l] = yt(c, a, i[c.defId], r, n);
                    }
                    return o;
                }
                function vt(e, t, r, n, i) {
                    var o = r.standardProps || {};
                    null == o.hasEnd && t.durationEditable && mt(t.startEditable ? r.startDelta : null, r.endDelta || null) && (o.hasEnd = !0);
                    var s = be({}, e, o, { ui: be({}, e.ui, o.ui) });
                    r.extendedProps && (s.extendedProps = be({}, s.extendedProps, r.extendedProps));
                    for (var a = 0, l = n; a < l.length; a++) {
                        var c = l[a];
                        c(s, r, i);
                    }
                    return !s.hasEnd && i.opt("forceEventDuration") && (s.hasEnd = !0), s;
                }
                function mt(e, t) {
                    return e && !te(e) && (e = null), t && !te(t) && (t = null), !((!e && !t) || (Boolean(e) === Boolean(t) && Q(e, t)));
                }
                function yt(e, t, r, n, i) {
                    var o = i.dateEnv,
                        s = n.standardProps && !0 === n.standardProps.allDay,
                        a = n.standardProps && !1 === n.standardProps.hasEnd,
                        l = be({}, e);
                    return (
                        s && (l.range = ve(l.range)),
                        n.startDelta && r.startEditable && (l.range = { start: o.add(l.range.start, n.startDelta), end: l.range.end }),
                        a
                            ? (l.range = { start: l.range.start, end: i.getDefaultEventEnd(t.allDay, l.range.start) })
                            : !n.endDelta || (!r.durationEditable && mt(r.startEditable ? n.startDelta : null, n.endDelta)) || (l.range = { start: l.range.start, end: o.add(l.range.end, n.endDelta) }),
                        t.allDay && (l.range = { start: A(l.range.start), end: A(l.range.end) }),
                        l.range.end < l.range.start && (l.range.end = i.getDefaultEventEnd(t.allDay, l.range.start)),
                        l
                    );
                }
                function St(e, t, r, n, i) {
                    switch (t.type) {
                        case "RECEIVE_EVENTS":
                            return (function (e, t, r, n, i, o) {
                                if (t && r === t.latestFetchId) {
                                    var s = Me(
                                        (function (e, t, r) {
                                            var n = r.opt("eventDataTransform"),
                                                i = t ? t.eventDataTransform : null;
                                            return i && (e = _e(e, i)), n && (e = _e(e, n)), e;
                                        })(i, t, o),
                                        t.sourceId,
                                        o
                                    );
                                    return n && (s = He(s, n, o)), Oe(Et(e, t.sourceId), s);
                                }
                                return e;
                            })(e, r[t.sourceId], t.fetchId, t.fetchRange, t.rawEvents, i);
                        case "ADD_EVENTS":
                            return (function (e, t, r, n) {
                                return r && (t = He(t, r, n)), Oe(e, t);
                            })(e, t.eventStore, n ? n.activeRange : null, i);
                        case "MERGE_EVENTS":
                            return Oe(e, t.eventStore);
                        case "PREV":
                        case "NEXT":
                        case "SET_DATE":
                        case "SET_VIEW_TYPE":
                            return n ? He(e, n.activeRange, i) : e;
                        case "CHANGE_TIMEZONE":
                            return (function (e, t, r) {
                                var n = e.defs,
                                    i = Ce(e.instances, function (e) {
                                        var i = n[e.defId];
                                        return i.allDay || i.recurringDef
                                            ? e
                                            : be({}, e, {
                                                  range: { start: r.createMarker(t.toDate(e.range.start, e.forcedStartTzo)), end: r.createMarker(t.toDate(e.range.end, e.forcedEndTzo)) },
                                                  forcedStartTzo: r.canComputeOffset ? null : e.forcedStartTzo,
                                                  forcedEndTzo: r.canComputeOffset ? null : e.forcedEndTzo,
                                              });
                                    });
                                return { defs: n, instances: i };
                            })(e, t.oldDateEnv, i.dateEnv);
                        case "MUTATE_EVENTS":
                            return (function (e, t, r, n, i) {
                                var o = ke(e, t),
                                    s = n ? { "": { startEditable: !0, durationEditable: !0, constraints: [], overlap: null, allows: [], backgroundColor: "", borderColor: "", textColor: "", classNames: [] } } : i.eventUiBases;
                                return (o = gt(o, s, r, i)), Oe(e, o);
                            })(e, t.instanceId, t.mutation, t.fromApi, i);
                        case "REMOVE_EVENT_INSTANCES":
                            return bt(e, t.instances);
                        case "REMOVE_EVENT_DEF":
                            return ze(e, function (e) {
                                return e.defId !== t.defId;
                            });
                        case "REMOVE_EVENT_SOURCE":
                            return Et(e, t.sourceId);
                        case "REMOVE_ALL_EVENT_SOURCES":
                            return ze(e, function (e) {
                                return !e.sourceId;
                            });
                        case "REMOVE_ALL_EVENTS":
                            return { defs: {}, instances: {} };
                        case "RESET_EVENTS":
                            return { defs: e.defs, instances: e.instances };
                        default:
                            return e;
                    }
                }
                function Et(e, t) {
                    return ze(e, function (e) {
                        return e.sourceId !== t;
                    });
                }
                function bt(e, t) {
                    return {
                        defs: e.defs,
                        instances: Te(e.instances, function (e) {
                            return !t[e.instanceId];
                        }),
                    };
                }
                function Dt(e, t) {
                    return wt({ eventDrag: e }, t);
                }
                function wt(e, t) {
                    var r = t.view,
                        n = be(
                            { businessHours: r ? r.props.businessHours : { defs: {}, instances: {} }, dateSelection: "", eventStore: t.state.eventStore, eventUiBases: t.eventUiBases, eventSelection: "", eventDrag: null, eventResize: null },
                            e
                        );
                    return (t.pluginSystem.hooks.isPropsValid || Tt)(n, t);
                }
                function Tt(e, t, r, n) {
                    return (
                        void 0 === r && (r = {}),
                        !(
                            (e.eventDrag &&
                                !(function (e, t, r, n) {
                                    var i = e.eventDrag,
                                        o = i.mutatedEvents,
                                        s = o.defs,
                                        a = o.instances,
                                        l = pt(s, i.isEvent ? e.eventUiBases : { "": t.selectionConfig });
                                    n && (l = Ce(l, n));
                                    var c = bt(e.eventStore, i.affectedEvents.instances),
                                        u = c.defs,
                                        d = c.instances,
                                        h = pt(u, e.eventUiBases);
                                    for (var p in a) {
                                        var f = a[p],
                                            g = f.range,
                                            v = l[f.defId],
                                            m = s[f.defId];
                                        if (!Ct(v.constraints, g, c, e.businessHours, t)) return !1;
                                        var y = t.opt("eventOverlap");
                                        for (var S in ("function" != typeof y && (y = null), d)) {
                                            var E = d[S];
                                            if (Ve(g, E.range)) {
                                                var b = h[E.defId].overlap;
                                                if (!1 === b && i.isEvent) return !1;
                                                if (!1 === v.overlap) return !1;
                                                if (y && !y(new lt(t, u[E.defId], E), new lt(t, m, f))) return !1;
                                            }
                                        }
                                        for (var D = 0, w = v.allows; D < w.length; D++) {
                                            var T = w[D],
                                                C = be({}, r, { range: f.range, allDay: m.allDay }),
                                                R = e.eventStore.defs[m.defId],
                                                I = e.eventStore.instances[p],
                                                M = void 0;
                                            if (((M = R ? new lt(t, R, I) : new lt(t, m)), !T(t.buildDateSpanApi(C), M))) return !1;
                                        }
                                    }
                                    return !0;
                                })(e, t, r, n)) ||
                            (e.dateSelection &&
                                !(function (e, t, r, n) {
                                    var i = e.eventStore,
                                        o = i.defs,
                                        s = i.instances,
                                        a = e.dateSelection,
                                        l = a.range,
                                        c = t.selectionConfig;
                                    if ((n && (c = n(c)), !Ct(c.constraints, l, i, e.businessHours, t))) return !1;
                                    var u = t.opt("selectOverlap");
                                    for (var d in ("function" != typeof u && (u = null), s)) {
                                        var h = s[d];
                                        if (Ve(l, h.range)) {
                                            if (!1 === c.overlap) return !1;
                                            if (u && !u(new lt(t, o[h.defId], h))) return !1;
                                        }
                                    }
                                    for (var p = 0, f = c.allows; p < f.length; p++) {
                                        var g = f[p],
                                            v = be({}, r, a);
                                        if (!g(t.buildDateSpanApi(v), null)) return !1;
                                    }
                                    return !0;
                                })(e, t, r, n))
                        )
                    );
                }
                function Ct(e, t, r, n, i) {
                    for (var o = 0, s = e; o < s.length; o++) {
                        var a = s[o];
                        if (!Mt(Rt(a, t, r, n, i), t)) return !1;
                    }
                    return !0;
                }
                function Rt(e, t, r, n, i) {
                    return "businessHours" === e
                        ? It(He(n, t, i))
                        : "string" == typeof e
                        ? It(
                              ze(r, function (t) {
                                  return t.groupId === e;
                              })
                          )
                        : "object" == typeof e && e
                        ? It(He(e, t, i))
                        : [];
                }
                function It(e) {
                    var t = e.instances,
                        r = [];
                    for (var n in t) r.push(t[n].range);
                    return r;
                }
                function Mt(e, t) {
                    for (var r = 0, n = e; r < n.length; r++) {
                        var i = n[r];
                        if (Ue(i, t)) return !0;
                    }
                    return !1;
                }
                function Pt(e) {
                    return (e + "").replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/'/g, "&#039;").replace(/"/g, "&quot;").replace(/\n/g, "<br />");
                }
                function Ht(e) {
                    var t = [];
                    for (var r in e) {
                        var n = e[r];
                        null != n && "" !== n && t.push(r + ":" + n);
                    }
                    return t.join(";");
                }
                function kt(e) {
                    return Array.isArray(e) ? e : "string" == typeof e ? e.split(/\s+/) : [];
                }
                var _t = {
                    editable: Boolean,
                    startEditable: Boolean,
                    durationEditable: Boolean,
                    constraint: null,
                    overlap: null,
                    allow: null,
                    className: kt,
                    classNames: kt,
                    color: String,
                    backgroundColor: String,
                    borderColor: String,
                    textColor: String,
                };
                function xt(e, t, r) {
                    var n = fe(e, _t, {}, r),
                        i = (function (e, t) {
                            return Array.isArray(e) ? Me(e, "", t, !0) : "object" == typeof e && e ? Me([e], "", t, !0) : null != e ? String(e) : null;
                        })(n.constraint, t);
                    return {
                        startEditable: null != n.startEditable ? n.startEditable : n.editable,
                        durationEditable: null != n.durationEditable ? n.durationEditable : n.editable,
                        constraints: null != i ? [i] : [],
                        overlap: n.overlap,
                        allows: null != n.allow ? [n.allow] : [],
                        backgroundColor: n.backgroundColor || n.color,
                        borderColor: n.borderColor || n.color,
                        textColor: n.textColor,
                        classNames: n.classNames.concat(n.className),
                    };
                }
                function Ot(e, t, r, n) {
                    var i = {},
                        o = {};
                    for (var s in _t) {
                        var a = e + le(s);
                        (i[s] = t[a]), (o[a] = !0);
                    }
                    if (("event" === e && (i.editable = t.editable), n)) for (var s in t) o[s] || (n[s] = t[s]);
                    return xt(i, r);
                }
                var zt = { startEditable: null, durationEditable: null, constraints: [], overlap: null, allows: [], backgroundColor: "", borderColor: "", textColor: "", classNames: [] };
                function Lt(e) {
                    return e.reduce(Nt, zt);
                }
                function Nt(e, t) {
                    return {
                        startEditable: null != t.startEditable ? t.startEditable : e.startEditable,
                        durationEditable: null != t.durationEditable ? t.durationEditable : e.durationEditable,
                        constraints: e.constraints.concat(t.constraints),
                        overlap: "boolean" == typeof t.overlap ? t.overlap : e.overlap,
                        allows: e.allows.concat(t.allows),
                        backgroundColor: t.backgroundColor || e.backgroundColor,
                        borderColor: t.borderColor || e.borderColor,
                        textColor: t.textColor || e.textColor,
                        classNames: e.classNames.concat(t.classNames),
                    };
                }
                var At = { id: String, groupId: String, title: String, url: String, rendering: String, extendedProps: null },
                    Bt = { start: null, date: null, end: null, allDay: null },
                    Vt = 0;
                function Ut(e, t, r, n) {
                    var i = (function (e, t) {
                            var r = null;
                            if (e) {
                                var n = t.state.eventSources[e];
                                r = n.allDayDefault;
                            }
                            return null == r && (r = t.opt("allDayDefault")), r;
                        })(t, r),
                        o = {},
                        s = (function (e, t, r, n, i) {
                            for (var o = 0; o < n.length; o++) {
                                var s = {},
                                    a = n[o].parse(e, s, r);
                                if (a) {
                                    var l = s.allDay;
                                    return delete s.allDay, null == l && null == (l = t) && null == (l = a.allDayGuess) && (l = !1), be(i, s), { allDay: l, duration: a.duration, typeData: a.typeData, typeId: o };
                                }
                            }
                            return null;
                        })(e, i, r.dateEnv, r.pluginSystem.hooks.recurringTypes, o);
                    if (s) {
                        var a = Wt(o, t, s.allDay, Boolean(s.duration), r);
                        return (a.recurringDef = { typeId: s.typeId, typeData: s.typeData, duration: s.duration }), { def: a, instance: null };
                    }
                    var l = {},
                        c = (function (e, t, r, n, i) {
                            var o,
                                s,
                                a = (function (e, t) {
                                    var r = fe(e, Bt, {}, t);
                                    return (r.start = null !== r.start ? r.start : r.date), delete r.date, r;
                                })(e, n),
                                l = a.allDay,
                                c = null,
                                u = !1,
                                d = null;
                            if ((o = r.dateEnv.createMarkerMeta(a.start))) c = o.marker;
                            else if (!i) return null;
                            return (
                                null != a.end && (s = r.dateEnv.createMarkerMeta(a.end)),
                                null == l && (l = null != t ? t : (!o || o.isTimeUnspecified) && (!s || s.isTimeUnspecified)),
                                l && c && (c = A(c)),
                                s && ((d = s.marker), l && (d = A(d)), c && d <= c && (d = null)),
                                d ? (u = !0) : i || ((u = r.opt("forceEventDuration") || !1), (d = r.dateEnv.add(c, l ? r.defaultAllDayEventDuration : r.defaultTimedEventDuration))),
                                { allDay: l, hasEnd: u, range: { start: c, end: d }, forcedStartTzo: o ? o.forcedTzo : null, forcedEndTzo: s ? s.forcedTzo : null }
                            );
                        })(e, i, r, l, n);
                    if (c) {
                        var a = Wt(l, t, c.allDay, c.hasEnd, r),
                            u = Ft(a.defId, c.range, c.forcedStartTzo, c.forcedEndTzo);
                        return { def: a, instance: u };
                    }
                    return null;
                }
                function Wt(e, t, r, n, i) {
                    var o = {},
                        s = (function (e, t, r) {
                            var n = {},
                                i = fe(e, At, {}, n),
                                o = xt(n, t, r);
                            return (i.publicId = i.id), delete i.id, (i.ui = o), i;
                        })(e, i, o);
                    (s.defId = String(Vt++)), (s.sourceId = t), (s.allDay = r), (s.hasEnd = n);
                    for (var a = 0, l = i.pluginSystem.hooks.eventDefParsers; a < l.length; a++) {
                        var c = l[a],
                            u = {};
                        c(s, o, u), (o = u);
                    }
                    return (s.extendedProps = be(o, s.extendedProps || {})), Object.freeze(s.ui.classNames), Object.freeze(s.extendedProps), s;
                }
                function Ft(e, t, r, n) {
                    return { instanceId: String(Vt++), defId: e, range: t, forcedStartTzo: null == r ? null : r, forcedEndTzo: null == n ? null : n };
                }
                var Gt = { startTime: "09:00", endTime: "17:00", daysOfWeek: [1, 2, 3, 4, 5], rendering: "inverse-background", classNames: "fc-nonbusiness", groupId: "_businessHours" };
                function jt(e, t) {
                    return Me(
                        (function (e) {
                            return (!0 === e
                                ? [{}]
                                : Array.isArray(e)
                                ? e.filter(function (e) {
                                      return e.daysOfWeek;
                                  })
                                : "object" == typeof e && e
                                ? [e]
                                : []
                            ).map(function (e) {
                                return be({}, Gt, e);
                            });
                        })(e),
                        "",
                        t
                    );
                }
                function Yt(e, t, r) {
                    void 0 === r && (r = []);
                    var n,
                        i,
                        o = [];
                    function s() {
                        if (i) {
                            for (var e = 0, r = o; e < r.length; e++) {
                                var s = r[e];
                                s.unrender();
                            }
                            t && t.apply(n, i), (i = null);
                        }
                    }
                    function a() {
                        (i && Fe(i, arguments)) || (s(), (n = this), (i = arguments), e.apply(this, arguments));
                    }
                    (a.dependents = o), (a.unrender = s);
                    for (var l = 0, c = r; l < c.length; l++) {
                        var u = c[l];
                        u.dependents.push(a);
                    }
                    return a;
                }
                function qt(e, t, r) {
                    return (
                        void 0 === r && (r = 1),
                        e === t ||
                            (Array.isArray(e) && Array.isArray(t)
                                ? (function (e, t, r) {
                                      if ((void 0 === r && (r = 1), e === t)) return !0;
                                      if (r > 0) {
                                          if (e.length !== t.length) return !1;
                                          for (var n = 0; n < e.length; n++) if (!qt(e[n], t[n], r - 1)) return !1;
                                          return !0;
                                      }
                                      return !1;
                                  })(e, t, r)
                                : !("object" != typeof e || !e || "object" != typeof t || !t) && Zt(e, t, r))
                    );
                }
                function Zt(e, t, r) {
                    if ((void 0 === r && (r = 1), e === t)) return !0;
                    if (r > 0) {
                        for (var n in e) if (!(n in t)) return !1;
                        for (var n in t) {
                            if (!(n in e)) return !1;
                            if (!qt(e[n], t[n], r - 1)) return !1;
                        }
                        return !0;
                    }
                    return !1;
                }
                var Xt = { defs: {}, instances: {} },
                    Jt = (function () {
                        function e() {
                            (this.getKeysForEventDefs = Ge(this._getKeysForEventDefs)),
                                (this.splitDateSelection = Ge(this._splitDateSpan)),
                                (this.splitEventStore = Ge(this._splitEventStore)),
                                (this.splitIndividualUi = Ge(this._splitIndividualUi)),
                                (this.splitEventDrag = Ge(this._splitInteraction)),
                                (this.splitEventResize = Ge(this._splitInteraction)),
                                (this.eventUiBuilders = {});
                        }
                        return (
                            (e.prototype.splitProps = function (e) {
                                var t = this,
                                    r = this.getKeyInfo(e),
                                    n = this.getKeysForEventDefs(e.eventStore),
                                    i = this.splitDateSelection(e.dateSelection),
                                    o = this.splitIndividualUi(e.eventUiBases, n),
                                    s = this.splitEventStore(e.eventStore, n),
                                    a = this.splitEventDrag(e.eventDrag),
                                    l = this.splitEventResize(e.eventResize),
                                    c = {};
                                for (var u in ((this.eventUiBuilders = Ce(r, function (e, r) {
                                    return t.eventUiBuilders[r] || Ge(Kt);
                                })),
                                r)) {
                                    var d = r[u],
                                        h = s[u] || Xt,
                                        p = this.eventUiBuilders[u];
                                    c[u] = {
                                        businessHours: d.businessHours || e.businessHours,
                                        dateSelection: i[u] || null,
                                        eventStore: h,
                                        eventUiBases: p(e.eventUiBases[""], d.ui, o[u]),
                                        eventSelection: h.instances[e.eventSelection] ? e.eventSelection : "",
                                        eventDrag: a[u] || null,
                                        eventResize: l[u] || null,
                                    };
                                }
                                return c;
                            }),
                            (e.prototype._splitDateSpan = function (e) {
                                var t = {};
                                if (e)
                                    for (var r = this.getKeysForDateSpan(e), n = 0, i = r; n < i.length; n++) {
                                        var o = i[n];
                                        t[o] = e;
                                    }
                                return t;
                            }),
                            (e.prototype._getKeysForEventDefs = function (e) {
                                var t = this;
                                return Ce(e.defs, function (e) {
                                    return t.getKeysForEventDef(e);
                                });
                            }),
                            (e.prototype._splitEventStore = function (e, t) {
                                var r = e.defs,
                                    n = e.instances,
                                    i = {};
                                for (var o in r)
                                    for (var s = 0, a = t[o]; s < a.length; s++) {
                                        var l = a[s];
                                        i[l] || (i[l] = { defs: {}, instances: {} }), (i[l].defs[o] = r[o]);
                                    }
                                for (var c in n)
                                    for (var u = n[c], d = 0, h = t[u.defId]; d < h.length; d++) {
                                        var l = h[d];
                                        i[l] && (i[l].instances[c] = u);
                                    }
                                return i;
                            }),
                            (e.prototype._splitIndividualUi = function (e, t) {
                                var r = {};
                                for (var n in e)
                                    if (n)
                                        for (var i = 0, o = t[n]; i < o.length; i++) {
                                            var s = o[i];
                                            r[s] || (r[s] = {}), (r[s][n] = e[n]);
                                        }
                                return r;
                            }),
                            (e.prototype._splitInteraction = function (e) {
                                var t = {};
                                if (e) {
                                    var r = this._splitEventStore(e.affectedEvents, this._getKeysForEventDefs(e.affectedEvents)),
                                        n = this._getKeysForEventDefs(e.mutatedEvents),
                                        i = this._splitEventStore(e.mutatedEvents, n),
                                        o = function (n) {
                                            t[n] || (t[n] = { affectedEvents: r[n] || Xt, mutatedEvents: i[n] || Xt, isEvent: e.isEvent, origSeg: e.origSeg });
                                        };
                                    for (var s in r) o(s);
                                    for (var s in i) o(s);
                                }
                                return t;
                            }),
                            e
                        );
                    })();
                function Kt(e, t, r) {
                    var n = [];
                    e && n.push(e), t && n.push(t);
                    var i = { "": Lt(n) };
                    return r && be(i, r), i;
                }
                function Qt(e, t, r, n) {
                    var i,
                        o,
                        s,
                        a,
                        l = e.dateEnv;
                    return (
                        t instanceof Date ? (i = t) : ((i = t.date), (o = t.type), (s = t.forceOff)),
                        (a = { date: l.formatIso(i, { omitTime: !0 }), type: o || "day" }),
                        "string" == typeof r && ((n = r), (r = null)),
                        (r = r
                            ? " " +
                              (function (e) {
                                  var t = [];
                                  for (var r in e) {
                                      var n = e[r];
                                      null != n && t.push(r + '="' + Pt(n) + '"');
                                  }
                                  return t.join(" ");
                              })(r)
                            : ""),
                        (n = n || ""),
                        !s && e.opt("navLinks") ? "<a" + r + ' data-goto="' + Pt(JSON.stringify(a)) + '">' + n + "</a>" : "<span" + r + ">" + n + "</span>"
                    );
                }
                function $t(e, t, r, n) {
                    var i,
                        o,
                        s = r.calendar,
                        a = r.view,
                        l = r.theme,
                        c = r.dateEnv,
                        u = [];
                    return (
                        We(t.activeRange, e)
                            ? (u.push("fc-" + k[e.getUTCDay()]),
                              a.opt("monthMode") && c.getMonth(e) !== c.getMonth(t.currentRange.start) && u.push("fc-other-month"),
                              (i = A(s.getNow())),
                              (o = _(i, 1)),
                              e < i ? u.push("fc-past") : e >= o ? u.push("fc-future") : (u.push("fc-today"), !0 !== n && u.push(l.getClass("today"))))
                            : u.push("fc-disabled-day"),
                        u
                    );
                }
                function er(e, t, r) {
                    var n = !1,
                        i = function () {
                            n || ((n = !0), t.apply(this, arguments));
                        },
                        o = function () {
                            n || ((n = !0), r && r.apply(this, arguments));
                        },
                        s = e(i, o);
                    s && "function" == typeof s.then && s.then(i, o);
                }
                var tr = (function () {
                        function e() {}
                        return (
                            (e.mixInto = function (e) {
                                this.mixIntoObj(e.prototype);
                            }),
                            (e.mixIntoObj = function (e) {
                                var t = this;
                                Object.getOwnPropertyNames(this.prototype).forEach(function (r) {
                                    e[r] || (e[r] = t.prototype[r]);
                                });
                            }),
                            (e.mixOver = function (e) {
                                var t = this;
                                Object.getOwnPropertyNames(this.prototype).forEach(function (r) {
                                    e.prototype[r] = t.prototype[r];
                                });
                            }),
                            e
                        );
                    })(),
                    rr = (function (e) {
                        function t() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.on = function (e, t) {
                                return nr(this._handlers || (this._handlers = {}), e, t), this;
                            }),
                            (t.prototype.one = function (e, t) {
                                return nr(this._oneHandlers || (this._oneHandlers = {}), e, t), this;
                            }),
                            (t.prototype.off = function (e, t) {
                                return this._handlers && ir(this._handlers, e, t), this._oneHandlers && ir(this._oneHandlers, e, t), this;
                            }),
                            (t.prototype.trigger = function (e) {
                                for (var t = [], r = 1; r < arguments.length; r++) t[r - 1] = arguments[r];
                                return this.triggerWith(e, this, t), this;
                            }),
                            (t.prototype.triggerWith = function (e, t, r) {
                                return this._handlers && de(this._handlers[e], t, r), this._oneHandlers && (de(this._oneHandlers[e], t, r), delete this._oneHandlers[e]), this;
                            }),
                            (t.prototype.hasHandlers = function (e) {
                                return (this._handlers && this._handlers[e] && this._handlers[e].length) || (this._oneHandlers && this._oneHandlers[e] && this._oneHandlers[e].length);
                            }),
                            t
                        );
                    })(tr);
                function nr(e, t, r) {
                    (e[t] || (e[t] = [])).push(r);
                }
                function ir(e, t, r) {
                    r
                        ? e[t] &&
                          (e[t] = e[t].filter(function (e) {
                              return e !== r;
                          }))
                        : delete e[t];
                }
                var or = (function () {
                        function e(e, t, r, n) {
                            (this.originEl = e), (this.els = t), (this.isHorizontal = r), (this.isVertical = n);
                        }
                        return (
                            (e.prototype.build = function () {
                                var e = this.originEl,
                                    t = (this.originClientRect = e.getBoundingClientRect());
                                this.isHorizontal && this.buildElHorizontals(t.left), this.isVertical && this.buildElVerticals(t.top);
                            }),
                            (e.prototype.buildElHorizontals = function (e) {
                                for (var t = [], r = [], n = 0, i = this.els; n < i.length; n++) {
                                    var o = i[n],
                                        s = o.getBoundingClientRect();
                                    t.push(s.left - e), r.push(s.right - e);
                                }
                                (this.lefts = t), (this.rights = r);
                            }),
                            (e.prototype.buildElVerticals = function (e) {
                                for (var t = [], r = [], n = 0, i = this.els; n < i.length; n++) {
                                    var o = i[n],
                                        s = o.getBoundingClientRect();
                                    t.push(s.top - e), r.push(s.bottom - e);
                                }
                                (this.tops = t), (this.bottoms = r);
                            }),
                            (e.prototype.leftToIndex = function (e) {
                                var t,
                                    r = this.lefts,
                                    n = this.rights,
                                    i = r.length;
                                for (t = 0; t < i; t++) if (e >= r[t] && e < n[t]) return t;
                            }),
                            (e.prototype.topToIndex = function (e) {
                                var t,
                                    r = this.tops,
                                    n = this.bottoms,
                                    i = r.length;
                                for (t = 0; t < i; t++) if (e >= r[t] && e < n[t]) return t;
                            }),
                            (e.prototype.getWidth = function (e) {
                                return this.rights[e] - this.lefts[e];
                            }),
                            (e.prototype.getHeight = function (e) {
                                return this.bottoms[e] - this.tops[e];
                            }),
                            e
                        );
                    })(),
                    sr = (function () {
                        function e() {}
                        return (
                            (e.prototype.getMaxScrollTop = function () {
                                return this.getScrollHeight() - this.getClientHeight();
                            }),
                            (e.prototype.getMaxScrollLeft = function () {
                                return this.getScrollWidth() - this.getClientWidth();
                            }),
                            (e.prototype.canScrollVertically = function () {
                                return this.getMaxScrollTop() > 0;
                            }),
                            (e.prototype.canScrollHorizontally = function () {
                                return this.getMaxScrollLeft() > 0;
                            }),
                            (e.prototype.canScrollUp = function () {
                                return this.getScrollTop() > 0;
                            }),
                            (e.prototype.canScrollDown = function () {
                                return this.getScrollTop() < this.getMaxScrollTop();
                            }),
                            (e.prototype.canScrollLeft = function () {
                                return this.getScrollLeft() > 0;
                            }),
                            (e.prototype.canScrollRight = function () {
                                return this.getScrollLeft() < this.getMaxScrollLeft();
                            }),
                            e
                        );
                    })(),
                    ar = (function (e) {
                        function t(t) {
                            var r = e.call(this) || this;
                            return (r.el = t), r;
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.getScrollTop = function () {
                                return this.el.scrollTop;
                            }),
                            (t.prototype.getScrollLeft = function () {
                                return this.el.scrollLeft;
                            }),
                            (t.prototype.setScrollTop = function (e) {
                                this.el.scrollTop = e;
                            }),
                            (t.prototype.setScrollLeft = function (e) {
                                this.el.scrollLeft = e;
                            }),
                            (t.prototype.getScrollWidth = function () {
                                return this.el.scrollWidth;
                            }),
                            (t.prototype.getScrollHeight = function () {
                                return this.el.scrollHeight;
                            }),
                            (t.prototype.getClientHeight = function () {
                                return this.el.clientHeight;
                            }),
                            (t.prototype.getClientWidth = function () {
                                return this.el.clientWidth;
                            }),
                            t
                        );
                    })(sr),
                    lr = (function (e) {
                        function t() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.getScrollTop = function () {
                                return window.pageYOffset;
                            }),
                            (t.prototype.getScrollLeft = function () {
                                return window.pageXOffset;
                            }),
                            (t.prototype.setScrollTop = function (e) {
                                window.scroll(window.pageXOffset, e);
                            }),
                            (t.prototype.setScrollLeft = function (e) {
                                window.scroll(e, window.pageYOffset);
                            }),
                            (t.prototype.getScrollWidth = function () {
                                return document.documentElement.scrollWidth;
                            }),
                            (t.prototype.getScrollHeight = function () {
                                return document.documentElement.scrollHeight;
                            }),
                            (t.prototype.getClientHeight = function () {
                                return document.documentElement.clientHeight;
                            }),
                            (t.prototype.getClientWidth = function () {
                                return document.documentElement.clientWidth;
                            }),
                            t
                        );
                    })(sr),
                    cr = (function (e) {
                        function t(t, r) {
                            var i = e.call(this, n("div", { className: "fc-scroller" })) || this;
                            return (i.overflowX = t), (i.overflowY = r), i.applyOverflow(), i;
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.clear = function () {
                                this.setHeight("auto"), this.applyOverflow();
                            }),
                            (t.prototype.destroy = function () {
                                u(this.el);
                            }),
                            (t.prototype.applyOverflow = function () {
                                m(this.el, { overflowX: this.overflowX, overflowY: this.overflowY });
                            }),
                            (t.prototype.lockOverflow = function (e) {
                                var t = this.overflowX,
                                    r = this.overflowY;
                                (e = e || this.getScrollbarWidths()),
                                    "auto" === t && (t = e.bottom || this.canScrollHorizontally() ? "scroll" : "hidden"),
                                    "auto" === r && (r = e.left || e.right || this.canScrollVertically() ? "scroll" : "hidden"),
                                    m(this.el, { overflowX: t, overflowY: r });
                            }),
                            (t.prototype.setHeight = function (e) {
                                y(this.el, "height", e);
                            }),
                            (t.prototype.getScrollbarWidths = function () {
                                var e = w(this.el);
                                return { left: e.scrollbarLeft, right: e.scrollbarRight, bottom: e.scrollbarBottom };
                            }),
                            t
                        );
                    })(ar),
                    ur = (function () {
                        function e(e) {
                            (this.calendarOptions = e), this.processIconOverride();
                        }
                        return (
                            (e.prototype.processIconOverride = function () {
                                this.iconOverrideOption && this.setIconOverride(this.calendarOptions[this.iconOverrideOption]);
                            }),
                            (e.prototype.setIconOverride = function (e) {
                                var t, r;
                                if ("object" == typeof e && e) {
                                    for (r in ((t = be({}, this.iconClasses)), e)) t[r] = this.applyIconOverridePrefix(e[r]);
                                    this.iconClasses = t;
                                } else !1 === e && (this.iconClasses = {});
                            }),
                            (e.prototype.applyIconOverridePrefix = function (e) {
                                var t = this.iconOverridePrefix;
                                return t && 0 !== e.indexOf(t) && (e = t + e), e;
                            }),
                            (e.prototype.getClass = function (e) {
                                return this.classes[e] || "";
                            }),
                            (e.prototype.getIconClass = function (e) {
                                var t = this.iconClasses[e];
                                return t ? this.baseIconClass + " " + t : "";
                            }),
                            (e.prototype.getCustomButtonIconClass = function (e) {
                                var t;
                                return this.iconOverrideCustomButtonOption && (t = e[this.iconOverrideCustomButtonOption]) ? this.baseIconClass + " " + this.applyIconOverridePrefix(t) : "";
                            }),
                            e
                        );
                    })();
                (ur.prototype.classes = {}), (ur.prototype.iconClasses = {}), (ur.prototype.baseIconClass = ""), (ur.prototype.iconOverridePrefix = "");
                var dr = 0,
                    hr = (function () {
                        function e(e, t) {
                            t && (e.view = this),
                                (this.uid = String(dr++)),
                                (this.context = e),
                                (this.dateEnv = e.dateEnv),
                                (this.theme = e.theme),
                                (this.view = e.view),
                                (this.calendar = e.calendar),
                                (this.isRtl = "rtl" === this.opt("dir"));
                        }
                        return (
                            (e.addEqualityFuncs = function (e) {
                                this.prototype.equalityFuncs = be({}, this.prototype.equalityFuncs, e);
                            }),
                            (e.prototype.opt = function (e) {
                                return this.context.options[e];
                            }),
                            (e.prototype.receiveProps = function (e) {
                                var t = (function (e, t, r) {
                                        var n = {},
                                            i = !1;
                                        for (var o in t) o in e && (e[o] === t[o] || (r[o] && r[o](e[o], t[o]))) ? (n[o] = e[o]) : ((n[o] = t[o]), (i = !0));
                                        for (var o in e)
                                            if (!(o in t)) {
                                                i = !0;
                                                break;
                                            }
                                        return { anyChanges: i, comboProps: n };
                                    })(this.props || {}, e, this.equalityFuncs),
                                    r = t.anyChanges,
                                    n = t.comboProps;
                                (this.props = n), r && this.render(n);
                            }),
                            (e.prototype.render = function (e) {}),
                            (e.prototype.destroy = function () {}),
                            e
                        );
                    })();
                hr.prototype.equalityFuncs = {};
                var pr = (function (e) {
                    function t(t, r, n) {
                        var i = e.call(this, t, n) || this;
                        return (i.el = r), i;
                    }
                    return (
                        Ee(t, e),
                        (t.prototype.destroy = function () {
                            e.prototype.destroy.call(this), u(this.el);
                        }),
                        (t.prototype.queryHit = function (e, t, r, n) {
                            return null;
                        }),
                        (t.prototype.isInteractionValid = function (e) {
                            var t = this.calendar,
                                r = this.props.dateProfile,
                                n = e.mutatedEvents.instances;
                            if (r) for (var i in n) if (!Ue(r.validRange, n[i].range)) return !1;
                            return Dt(e, t);
                        }),
                        (t.prototype.isDateSelectionValid = function (e) {
                            var t,
                                r,
                                n = this.props.dateProfile;
                            return !(n && !Ue(n.validRange, e.range)) && ((t = e), (r = this.calendar), wt({ dateSelection: t }, r));
                        }),
                        (t.prototype.publiclyTrigger = function (e, t) {
                            var r = this.calendar;
                            return r.publiclyTrigger(e, t);
                        }),
                        (t.prototype.publiclyTriggerAfterSizing = function (e, t) {
                            var r = this.calendar;
                            return r.publiclyTriggerAfterSizing(e, t);
                        }),
                        (t.prototype.hasPublicHandlers = function (e) {
                            var t = this.calendar;
                            return t.hasPublicHandlers(e);
                        }),
                        (t.prototype.triggerRenderedSegs = function (e, t) {
                            var r = this.calendar;
                            if (this.hasPublicHandlers("eventPositioned"))
                                for (var n = 0, i = e; n < i.length; n++) {
                                    var o = i[n];
                                    this.publiclyTriggerAfterSizing("eventPositioned", [{ event: new lt(r, o.eventRange.def, o.eventRange.instance), isMirror: t, isStart: o.isStart, isEnd: o.isEnd, el: o.el, view: this }]);
                                }
                            r.state.loadingLevel || (r.afterSizingTriggers._eventsPositioned = [null]);
                        }),
                        (t.prototype.triggerWillRemoveSegs = function (e, t) {
                            for (var r = this.calendar, n = 0, i = e; n < i.length; n++) {
                                var o = i[n];
                                r.trigger("eventElRemove", o.el);
                            }
                            if (this.hasPublicHandlers("eventDestroy"))
                                for (var s = 0, a = e; s < a.length; s++) {
                                    var o = a[s];
                                    this.publiclyTrigger("eventDestroy", [{ event: new lt(r, o.eventRange.def, o.eventRange.instance), isMirror: t, el: o.el, view: this }]);
                                }
                        }),
                        (t.prototype.isValidSegDownEl = function (e) {
                            return !this.props.eventDrag && !this.props.eventResize && !p(e, ".fc-mirror") && (this.isPopover() || !this.isInPopover(e));
                        }),
                        (t.prototype.isValidDateDownEl = function (e) {
                            var t = p(e, this.fgSegSelector);
                            return (!t || t.classList.contains("fc-mirror")) && !p(e, ".fc-more") && !p(e, "a[data-goto]") && !this.isInPopover(e);
                        }),
                        (t.prototype.isPopover = function () {
                            return this.el.classList.contains("fc-popover");
                        }),
                        (t.prototype.isInPopover = function (e) {
                            return Boolean(p(e, ".fc-popover"));
                        }),
                        t
                    );
                })(hr);
                (pr.prototype.fgSegSelector = ".fc-event-container > *"), (pr.prototype.bgSegSelector = ".fc-bgevent:not(.fc-nonbusiness)");
                var fr = 0;
                function gr(e) {
                    return {
                        id: String(fr++),
                        deps: e.deps || [],
                        reducers: e.reducers || [],
                        eventDefParsers: e.eventDefParsers || [],
                        eventDragMutationMassagers: e.eventDragMutationMassagers || [],
                        eventDefMutationAppliers: e.eventDefMutationAppliers || [],
                        dateSelectionTransformers: e.dateSelectionTransformers || [],
                        datePointTransforms: e.datePointTransforms || [],
                        dateSpanTransforms: e.dateSpanTransforms || [],
                        views: e.views || {},
                        viewPropsTransformers: e.viewPropsTransformers || [],
                        isPropsValid: e.isPropsValid || null,
                        externalDefTransforms: e.externalDefTransforms || [],
                        eventResizeJoinTransforms: e.eventResizeJoinTransforms || [],
                        viewContainerModifiers: e.viewContainerModifiers || [],
                        eventDropTransformers: e.eventDropTransformers || [],
                        componentInteractions: e.componentInteractions || [],
                        calendarInteractions: e.calendarInteractions || [],
                        themeClasses: e.themeClasses || {},
                        eventSourceDefs: e.eventSourceDefs || [],
                        cmdFormatter: e.cmdFormatter,
                        recurringTypes: e.recurringTypes || [],
                        namedTimeZonedImpl: e.namedTimeZonedImpl,
                        defaultView: e.defaultView || "",
                        elementDraggingImpl: e.elementDraggingImpl,
                        optionChangeHandlers: e.optionChangeHandlers || {},
                    };
                }
                var vr = (function () {
                        function e() {
                            (this.hooks = {
                                reducers: [],
                                eventDefParsers: [],
                                eventDragMutationMassagers: [],
                                eventDefMutationAppliers: [],
                                dateSelectionTransformers: [],
                                datePointTransforms: [],
                                dateSpanTransforms: [],
                                views: {},
                                viewPropsTransformers: [],
                                isPropsValid: null,
                                externalDefTransforms: [],
                                eventResizeJoinTransforms: [],
                                viewContainerModifiers: [],
                                eventDropTransformers: [],
                                componentInteractions: [],
                                calendarInteractions: [],
                                themeClasses: {},
                                eventSourceDefs: [],
                                cmdFormatter: null,
                                recurringTypes: [],
                                namedTimeZonedImpl: null,
                                defaultView: "",
                                elementDraggingImpl: null,
                                optionChangeHandlers: {},
                            }),
                                (this.addedHash = {});
                        }
                        return (
                            (e.prototype.add = function (e) {
                                if (!this.addedHash[e.id]) {
                                    this.addedHash[e.id] = !0;
                                    for (var t = 0, r = e.deps; t < r.length; t++) {
                                        var n = r[t];
                                        this.add(n);
                                    }
                                    this.hooks =
                                        ((i = this.hooks),
                                        (o = e),
                                        {
                                            reducers: i.reducers.concat(o.reducers),
                                            eventDefParsers: i.eventDefParsers.concat(o.eventDefParsers),
                                            eventDragMutationMassagers: i.eventDragMutationMassagers.concat(o.eventDragMutationMassagers),
                                            eventDefMutationAppliers: i.eventDefMutationAppliers.concat(o.eventDefMutationAppliers),
                                            dateSelectionTransformers: i.dateSelectionTransformers.concat(o.dateSelectionTransformers),
                                            datePointTransforms: i.datePointTransforms.concat(o.datePointTransforms),
                                            dateSpanTransforms: i.dateSpanTransforms.concat(o.dateSpanTransforms),
                                            views: be({}, i.views, o.views),
                                            viewPropsTransformers: i.viewPropsTransformers.concat(o.viewPropsTransformers),
                                            isPropsValid: o.isPropsValid || i.isPropsValid,
                                            externalDefTransforms: i.externalDefTransforms.concat(o.externalDefTransforms),
                                            eventResizeJoinTransforms: i.eventResizeJoinTransforms.concat(o.eventResizeJoinTransforms),
                                            viewContainerModifiers: i.viewContainerModifiers.concat(o.viewContainerModifiers),
                                            eventDropTransformers: i.eventDropTransformers.concat(o.eventDropTransformers),
                                            calendarInteractions: i.calendarInteractions.concat(o.calendarInteractions),
                                            componentInteractions: i.componentInteractions.concat(o.componentInteractions),
                                            themeClasses: be({}, i.themeClasses, o.themeClasses),
                                            eventSourceDefs: i.eventSourceDefs.concat(o.eventSourceDefs),
                                            cmdFormatter: o.cmdFormatter || i.cmdFormatter,
                                            recurringTypes: i.recurringTypes.concat(o.recurringTypes),
                                            namedTimeZonedImpl: o.namedTimeZonedImpl || i.namedTimeZonedImpl,
                                            defaultView: i.defaultView || o.defaultView,
                                            elementDraggingImpl: i.elementDraggingImpl || o.elementDraggingImpl,
                                            optionChangeHandlers: be({}, i.optionChangeHandlers, o.optionChangeHandlers),
                                        });
                                }
                                var i, o;
                            }),
                            e
                        );
                    })(),
                    mr = gr({
                        eventSourceDefs: [
                            {
                                ignoreRange: !0,
                                parseMeta: function (e) {
                                    return Array.isArray(e) ? e : Array.isArray(e.events) ? e.events : null;
                                },
                                fetch: function (e, t) {
                                    t({ rawEvents: e.eventSource.meta });
                                },
                            },
                        ],
                    }),
                    yr = gr({
                        eventSourceDefs: [
                            {
                                parseMeta: function (e) {
                                    return "function" == typeof e ? e : "function" == typeof e.events ? e.events : null;
                                },
                                fetch: function (e, t, r) {
                                    var n = e.calendar.dateEnv,
                                        i = e.eventSource.meta;
                                    er(
                                        i.bind(null, { start: n.toDate(e.range.start), end: n.toDate(e.range.end), startStr: n.formatIso(e.range.start), endStr: n.formatIso(e.range.end), timeZone: n.timeZone }),
                                        function (e) {
                                            t({ rawEvents: e });
                                        },
                                        r
                                    );
                                },
                            },
                        ],
                    });
                function Sr(e, t, r, n, i) {
                    e = e.toUpperCase();
                    var o = null;
                    "GET" === e
                        ? (t = (function (e, t) {
                              return e + (-1 === e.indexOf("?") ? "?" : "&") + Er(t);
                          })(t, r))
                        : (o = Er(r));
                    var s = new XMLHttpRequest();
                    s.open(e, t, !0),
                        "GET" !== e && s.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"),
                        (s.onload = function () {
                            if (s.status >= 200 && s.status < 400)
                                try {
                                    var e = JSON.parse(s.responseText);
                                    n(e, s);
                                } catch (e) {
                                    i("Failure parsing JSON", s);
                                }
                            else i("Request failed", s);
                        }),
                        (s.onerror = function () {
                            i("Request failed", s);
                        }),
                        s.send(o);
                }
                function Er(e) {
                    var t = [];
                    for (var r in e) t.push(encodeURIComponent(r) + "=" + encodeURIComponent(e[r]));
                    return t.join("&");
                }
                var br = gr({
                        eventSourceDefs: [
                            {
                                parseMeta: function (e) {
                                    if ("string" == typeof e) e = { url: e };
                                    else if (!e || "object" != typeof e || !e.url) return null;
                                    return { url: e.url, method: (e.method || "GET").toUpperCase(), extraParams: e.extraParams, startParam: e.startParam, endParam: e.endParam, timeZoneParam: e.timeZoneParam };
                                },
                                fetch: function (e, t, r) {
                                    var n = e.eventSource.meta,
                                        i = (function (e, t, r) {
                                            var n,
                                                i,
                                                o,
                                                s,
                                                a = r.dateEnv,
                                                l = {};
                                            return (
                                                null == (n = e.startParam) && (n = r.opt("startParam")),
                                                null == (i = e.endParam) && (i = r.opt("endParam")),
                                                null == (o = e.timeZoneParam) && (o = r.opt("timeZoneParam")),
                                                (s = "function" == typeof e.extraParams ? e.extraParams() : e.extraParams || {}),
                                                be(l, s),
                                                (l[n] = a.formatIso(t.start)),
                                                (l[i] = a.formatIso(t.end)),
                                                "local" !== a.timeZone && (l[o] = a.timeZone),
                                                l
                                            );
                                        })(n, e.range, e.calendar);
                                    Sr(
                                        n.method,
                                        n.url,
                                        i,
                                        function (e, r) {
                                            t({ rawEvents: e, xhr: r });
                                        },
                                        function (e, t) {
                                            r({ message: e, xhr: t });
                                        }
                                    );
                                },
                            },
                        ],
                    }),
                    Dr = gr({
                        recurringTypes: [
                            {
                                parse: function (e, t, r) {
                                    var n = r.createMarker.bind(r),
                                        i = { daysOfWeek: null, startTime: X, endTime: X, startRecur: n, endRecur: n },
                                        o = fe(e, i, {}, t),
                                        s = !1;
                                    for (var a in o)
                                        if (null != o[a]) {
                                            s = !0;
                                            break;
                                        }
                                    return s ? { allDayGuess: Boolean(!o.startTime && !o.endTime), duration: o.startTime && o.endTime ? $(o.endTime, o.startTime) : null, typeData: o } : null;
                                },
                                expand: function (e, t, r) {
                                    var n = Ae(t, { start: e.startRecur, end: e.endRecur });
                                    return n
                                        ? (function (e, t, r, n) {
                                              for (var i = e ? Re(e) : null, o = A(r.start), s = r.end, a = []; o < s; ) {
                                                  var l = void 0;
                                                  (i && !i[o.getUTCDay()]) || ((l = t ? n.add(o, t) : o), a.push(l)), (o = _(o, 1));
                                              }
                                              return a;
                                          })(e.daysOfWeek, e.startTime, n, r)
                                        : [];
                                },
                            },
                        ],
                    }),
                    wr = gr({
                        optionChangeHandlers: {
                            events: function (e, t) {
                                Tr([e], t);
                            },
                            eventSources: Tr,
                            plugins: function (e, t) {
                                t.addPluginInputs(e);
                            },
                        },
                    });
                function Tr(e, t) {
                    for (var r = Ie(t.state.eventSources), n = [], i = 0, o = e; i < o.length; i++) {
                        for (var s = o[i], a = !1, l = 0; l < r.length; l++)
                            if (qt(r[l]._raw, s, 2)) {
                                r.splice(l, 1), (a = !0);
                                break;
                            }
                        a || n.push(s);
                    }
                    for (var c = 0, u = r; c < u.length; c++) {
                        var d = u[c];
                        t.dispatch({ type: "REMOVE_EVENT_SOURCE", sourceId: d.sourceId });
                    }
                    for (var h = 0, p = n; h < p.length; h++) {
                        var f = p[h];
                        t.addEventSource(f);
                    }
                }
                var Cr = {
                        defaultRangeSeparator: " - ",
                        titleRangeSeparator: " – ",
                        defaultTimedEventDuration: "01:00:00",
                        defaultAllDayEventDuration: { day: 1 },
                        forceEventDuration: !1,
                        nextDayThreshold: "00:00:00",
                        columnHeader: !0,
                        defaultView: "",
                        aspectRatio: 1.35,
                        header: { left: "title", center: "", right: "today prev,next" },
                        weekends: !0,
                        weekNumbers: !1,
                        weekNumberCalculation: "local",
                        editable: !1,
                        scrollTime: "06:00:00",
                        minTime: "00:00:00",
                        maxTime: "24:00:00",
                        showNonCurrentDates: !0,
                        lazyFetching: !0,
                        startParam: "start",
                        endParam: "end",
                        timeZoneParam: "timeZone",
                        timeZone: "local",
                        locales: [],
                        locale: "",
                        timeGridEventMinHeight: 0,
                        themeSystem: "standard",
                        dragRevertDuration: 500,
                        dragScroll: !0,
                        allDayMaintainDuration: !1,
                        unselectAuto: !0,
                        dropAccept: "*",
                        eventOrder: "start,-duration,allDay,title",
                        eventLimit: !1,
                        eventLimitClick: "popover",
                        dayPopoverFormat: { month: "long", day: "numeric", year: "numeric" },
                        handleWindowResize: !0,
                        windowResizeDelay: 100,
                        longPressDelay: 1e3,
                        eventDragMinDistance: 5,
                    },
                    Rr = {
                        header: { left: "next,prev today", center: "", right: "title" },
                        buttonIcons: { prev: "fc-icon-chevron-right", next: "fc-icon-chevron-left", prevYear: "fc-icon-chevrons-right", nextYear: "fc-icon-chevrons-left" },
                    },
                    Ir = ["header", "footer", "buttonText", "buttonIcons"],
                    Mr = [mr, yr, br, Dr, wr],
                    Pr = {
                        code: "en",
                        week: { dow: 0, doy: 4 },
                        dir: "ltr",
                        buttonText: { prev: "prev", next: "next", prevYear: "prev year", nextYear: "next year", year: "year", today: "Сегодня", month: "Месяц", week: "Неделя", day: "День", list: "list" },
                        weekLabel: "№ недели",
                        allDayText: "Целый день",
                        eventLimitText: "more",
                        noEventsMessage: "No events to display",
                    };
                function Hr(e) {
                    for (var t = e.length > 0 ? e[0].code : "en", r = window.FullCalendarLocalesAll || [], n = window.FullCalendarLocales || {}, i = r.concat(Ie(n), e), o = { en: Pr }, s = 0, a = i; s < a.length; s++) {
                        var l = a[s];
                        o[l.code] = l;
                    }
                    return { map: o, defaultCode: t };
                }
                function kr(e, t) {
                    return "object" != typeof e || Array.isArray(e)
                        ? (function (e, t) {
                              var r = [].concat(e || []),
                                  n =
                                      (function (e, t) {
                                          for (var r = 0; r < e.length; r++)
                                              for (var n = e[r].toLocaleLowerCase().split("-"), i = n.length; i > 0; i--) {
                                                  var o = n.slice(0, i).join("-");
                                                  if (t[o]) return t[o];
                                              }
                                          return null;
                                      })(r, t) || Pr;
                              return _r(e, r, n);
                          })(e, t)
                        : _r(e.code, [e.code], e);
                }
                function _r(e, t, r) {
                    var n = we([Pr, r], ["buttonText"]);
                    delete n.code;
                    var i = n.week;
                    return delete n.week, { codeArg: e, codes: t, week: i, simpleNumberFormat: new Intl.NumberFormat(e), options: n };
                }
                var xr,
                    Or,
                    zr = (function () {
                        function e(e) {
                            (this.overrides = be({}, e)), (this.dynamicOverrides = {}), this.compute();
                        }
                        return (
                            (e.prototype.add = function (e) {
                                be(this.overrides, e), this.compute();
                            }),
                            (e.prototype.addDynamic = function (e) {
                                be(this.dynamicOverrides, e), this.compute();
                            }),
                            (e.prototype.reset = function (e) {
                                (this.overrides = e), this.compute();
                            }),
                            (e.prototype.compute = function () {
                                var e = he(this.dynamicOverrides.locales, this.overrides.locales, Cr.locales),
                                    t = he(this.dynamicOverrides.locale, this.overrides.locale, Cr.locale),
                                    r = Hr(e),
                                    n = kr(t || r.defaultCode, r.map).options,
                                    i = he(this.dynamicOverrides.dir, this.overrides.dir, n.dir),
                                    o = "rtl" === i ? Rr : {};
                                (this.dirDefaults = o), (this.localeDefaults = n), (this.computed = we([Cr, o, n, this.overrides, this.dynamicOverrides], Ir));
                            }),
                            e
                        );
                    })(),
                    Lr = {};
                (xr = "gregory"),
                    (Or = (function () {
                        function e() {}
                        return (
                            (e.prototype.getMarkerYear = function (e) {
                                return e.getUTCFullYear();
                            }),
                            (e.prototype.getMarkerMonth = function (e) {
                                return e.getUTCMonth();
                            }),
                            (e.prototype.getMarkerDay = function (e) {
                                return e.getUTCDate();
                            }),
                            (e.prototype.arrayToMarker = function (e) {
                                return G(e);
                            }),
                            (e.prototype.markerToArray = function (e) {
                                return F(e);
                            }),
                            e
                        );
                    })()),
                    (Lr[xr] = Or);
                var Nr = /^\s*\d{4}-\d\d-\d\d([T ]\d)?/,
                    Ar = /(?:(Z)|([-+])(\d\d)(?::(\d\d))?)$/;
                function Br(e) {
                    var t = null,
                        r = !1,
                        n = Nr.exec(e);
                    n &&
                        ((r = !n[1])
                            ? (e += "T00:00:00Z")
                            : (e =
                                  e.replace(Ar, function (e, r, n, i, o) {
                                      return (t = r ? 0 : (60 * parseInt(i, 10) + parseInt(o || 0, 10)) * ("-" === n ? -1 : 1)), "";
                                  }) + "Z"));
                    var i = new Date(e);
                    return j(i) ? { marker: i, isTimeUnspecified: r, timeZoneOffset: t } : null;
                }
                var Vr = (function () {
                        function e(e) {
                            var t,
                                r = (this.timeZone = e.timeZone),
                                n = "local" !== r && "UTC" !== r;
                            e.namedTimeZoneImpl && n && (this.namedTimeZoneImpl = new e.namedTimeZoneImpl(r)),
                                (this.canComputeOffset = Boolean(!n || this.namedTimeZoneImpl)),
                                (this.calendarSystem = ((t = e.calendarSystem), new Lr[t]())),
                                (this.locale = e.locale),
                                (this.weekDow = e.locale.week.dow),
                                (this.weekDoy = e.locale.week.doy),
                                "ISO" === e.weekNumberCalculation ? ((this.weekDow = 1), (this.weekDoy = 4)) : "number" == typeof e.firstDay && (this.weekDow = e.firstDay),
                                "function" == typeof e.weekNumberCalculation && (this.weekNumberFunc = e.weekNumberCalculation),
                                (this.weekLabel = null != e.weekLabel ? e.weekLabel : e.locale.options.weekLabel),
                                (this.cmdFormatter = e.cmdFormatter);
                        }
                        return (
                            (e.prototype.createMarker = function (e) {
                                var t = this.createMarkerMeta(e);
                                return null === t ? null : t.marker;
                            }),
                            (e.prototype.createNowMarker = function () {
                                return this.canComputeOffset ? this.timestampToMarker(new Date().valueOf()) : G(U(new Date()));
                            }),
                            (e.prototype.createMarkerMeta = function (e) {
                                if ("string" == typeof e) return this.parse(e);
                                var t = null;
                                return (
                                    "number" == typeof e ? (t = this.timestampToMarker(e)) : e instanceof Date ? ((e = e.valueOf()), isNaN(e) || (t = this.timestampToMarker(e))) : Array.isArray(e) && (t = G(e)),
                                    null !== t && j(t) ? { marker: t, isTimeUnspecified: !1, forcedTzo: null } : null
                                );
                            }),
                            (e.prototype.parse = function (e) {
                                var t = Br(e);
                                if (null === t) return null;
                                var r = t.marker,
                                    n = null;
                                return (
                                    null !== t.timeZoneOffset && (this.canComputeOffset ? (r = this.timestampToMarker(r.valueOf() - 60 * t.timeZoneOffset * 1e3)) : (n = t.timeZoneOffset)),
                                    { marker: r, isTimeUnspecified: t.isTimeUnspecified, forcedTzo: n }
                                );
                            }),
                            (e.prototype.getYear = function (e) {
                                return this.calendarSystem.getMarkerYear(e);
                            }),
                            (e.prototype.getMonth = function (e) {
                                return this.calendarSystem.getMarkerMonth(e);
                            }),
                            (e.prototype.add = function (e, t) {
                                var r = this.calendarSystem.markerToArray(e);
                                return (r[0] += t.years), (r[1] += t.months), (r[2] += t.days), (r[6] += t.milliseconds), this.calendarSystem.arrayToMarker(r);
                            }),
                            (e.prototype.subtract = function (e, t) {
                                var r = this.calendarSystem.markerToArray(e);
                                return (r[0] -= t.years), (r[1] -= t.months), (r[2] -= t.days), (r[6] -= t.milliseconds), this.calendarSystem.arrayToMarker(r);
                            }),
                            (e.prototype.addYears = function (e, t) {
                                var r = this.calendarSystem.markerToArray(e);
                                return (r[0] += t), this.calendarSystem.arrayToMarker(r);
                            }),
                            (e.prototype.addMonths = function (e, t) {
                                var r = this.calendarSystem.markerToArray(e);
                                return (r[1] += t), this.calendarSystem.arrayToMarker(r);
                            }),
                            (e.prototype.diffWholeYears = function (e, t) {
                                var r = this.calendarSystem;
                                return Y(e) === Y(t) && r.getMarkerDay(e) === r.getMarkerDay(t) && r.getMarkerMonth(e) === r.getMarkerMonth(t) ? r.getMarkerYear(t) - r.getMarkerYear(e) : null;
                            }),
                            (e.prototype.diffWholeMonths = function (e, t) {
                                var r = this.calendarSystem;
                                return Y(e) === Y(t) && r.getMarkerDay(e) === r.getMarkerDay(t) ? r.getMarkerMonth(t) - r.getMarkerMonth(e) + 12 * (r.getMarkerYear(t) - r.getMarkerYear(e)) : null;
                            }),
                            (e.prototype.greatestWholeUnit = function (e, t) {
                                var r = this.diffWholeYears(e, t);
                                return null !== r
                                    ? { unit: "year", value: r }
                                    : null !== (r = this.diffWholeMonths(e, t))
                                    ? { unit: "month", value: r }
                                    : null !== (r = L(e, t))
                                    ? { unit: "week", value: r }
                                    : null !== (r = N(e, t))
                                    ? { unit: "day", value: r }
                                    : ue(
                                          (r = (function (e, t) {
                                              return (t.valueOf() - e.valueOf()) / 36e5;
                                          })(e, t))
                                      )
                                    ? { unit: "hour", value: r }
                                    : ue(
                                          (r = (function (e, t) {
                                              return (t.valueOf() - e.valueOf()) / 6e4;
                                          })(e, t))
                                      )
                                    ? { unit: "minute", value: r }
                                    : ue(
                                          (r = (function (e, t) {
                                              return (t.valueOf() - e.valueOf()) / 1e3;
                                          })(e, t))
                                      )
                                    ? { unit: "second", value: r }
                                    : { unit: "millisecond", value: t.valueOf() - e.valueOf() };
                            }),
                            (e.prototype.countDurationsBetween = function (e, t, r) {
                                var n;
                                return r.years && null !== (n = this.diffWholeYears(e, t))
                                    ? n / (ee(r) / 365)
                                    : r.months && null !== (n = this.diffWholeMonths(e, t))
                                    ? n /
                                      (function (e) {
                                          return ee(e) / 30;
                                      })(r)
                                    : r.days && null !== (n = N(e, t))
                                    ? n / ee(r)
                                    : (t.valueOf() - e.valueOf()) / te(r);
                            }),
                            (e.prototype.startOf = function (e, t) {
                                return "year" === t
                                    ? this.startOfYear(e)
                                    : "month" === t
                                    ? this.startOfMonth(e)
                                    : "week" === t
                                    ? this.startOfWeek(e)
                                    : "day" === t
                                    ? A(e)
                                    : "hour" === t
                                    ? (function (e) {
                                          return G([e.getUTCFullYear(), e.getUTCMonth(), e.getUTCDate(), e.getUTCHours()]);
                                      })(e)
                                    : "minute" === t
                                    ? (function (e) {
                                          return G([e.getUTCFullYear(), e.getUTCMonth(), e.getUTCDate(), e.getUTCHours(), e.getUTCMinutes()]);
                                      })(e)
                                    : "second" === t
                                    ? (function (e) {
                                          return G([e.getUTCFullYear(), e.getUTCMonth(), e.getUTCDate(), e.getUTCHours(), e.getUTCMinutes(), e.getUTCSeconds()]);
                                      })(e)
                                    : void 0;
                            }),
                            (e.prototype.startOfYear = function (e) {
                                return this.calendarSystem.arrayToMarker([this.calendarSystem.getMarkerYear(e)]);
                            }),
                            (e.prototype.startOfMonth = function (e) {
                                return this.calendarSystem.arrayToMarker([this.calendarSystem.getMarkerYear(e), this.calendarSystem.getMarkerMonth(e)]);
                            }),
                            (e.prototype.startOfWeek = function (e) {
                                return this.calendarSystem.arrayToMarker([this.calendarSystem.getMarkerYear(e), this.calendarSystem.getMarkerMonth(e), e.getUTCDate() - ((e.getUTCDay() - this.weekDow + 7) % 7)]);
                            }),
                            (e.prototype.computeWeekNumber = function (e) {
                                return this.weekNumberFunc
                                    ? this.weekNumberFunc(this.toDate(e))
                                    : (function (e, t, r) {
                                          var n = e.getUTCFullYear(),
                                              i = B(e, n, t, r);
                                          if (i < 1) return B(e, n - 1, t, r);
                                          var o = B(e, n + 1, t, r);
                                          return o >= 1 ? Math.min(i, o) : i;
                                      })(e, this.weekDow, this.weekDoy);
                            }),
                            (e.prototype.format = function (e, t, r) {
                                return void 0 === r && (r = {}), t.format({ marker: e, timeZoneOffset: null != r.forcedTzo ? r.forcedTzo : this.offsetForMarker(e) }, this);
                            }),
                            (e.prototype.formatRange = function (e, t, r, n) {
                                return (
                                    void 0 === n && (n = {}),
                                    n.isEndExclusive && (t = x(t, -1)),
                                    r.formatRange(
                                        { marker: e, timeZoneOffset: null != n.forcedStartTzo ? n.forcedStartTzo : this.offsetForMarker(e) },
                                        { marker: t, timeZoneOffset: null != n.forcedEndTzo ? n.forcedEndTzo : this.offsetForMarker(t) },
                                        this
                                    )
                                );
                            }),
                            (e.prototype.formatIso = function (e, t) {
                                void 0 === t && (t = {});
                                var r = null;
                                return (
                                    t.omitTimeZoneOffset || (r = null != t.forcedTzo ? t.forcedTzo : this.offsetForMarker(e)),
                                    (function (e, t, r) {
                                        void 0 === r && (r = !1);
                                        var n = e.toISOString();
                                        return (n = n.replace(".000", "")), r && (n = n.replace("T00:00:00Z", "")), n.length > 10 && (null == t ? (n = n.replace("Z", "")) : 0 !== t && (n = n.replace("Z", it(t, !0)))), n;
                                    })(e, r, t.omitTime)
                                );
                            }),
                            (e.prototype.timestampToMarker = function (e) {
                                return "local" === this.timeZone ? G(U(new Date(e))) : "UTC" !== this.timeZone && this.namedTimeZoneImpl ? G(this.namedTimeZoneImpl.timestampToArray(e)) : new Date(e);
                            }),
                            (e.prototype.offsetForMarker = function (e) {
                                return "local" === this.timeZone ? -W(F(e)).getTimezoneOffset() : "UTC" === this.timeZone ? 0 : this.namedTimeZoneImpl ? this.namedTimeZoneImpl.offsetForArray(F(e)) : null;
                            }),
                            (e.prototype.toDate = function (e, t) {
                                return "local" === this.timeZone
                                    ? W(F(e))
                                    : "UTC" === this.timeZone
                                    ? new Date(e.valueOf())
                                    : this.namedTimeZoneImpl
                                    ? new Date(e.valueOf() - 1e3 * this.namedTimeZoneImpl.offsetForArray(F(e)) * 60)
                                    : new Date(e.valueOf() - (t || 0));
                            }),
                            e
                        );
                    })(),
                    Ur = { id: String, allDayDefault: Boolean, eventDataTransform: Function, success: Function, failure: Function },
                    Wr = 0;
                function Fr(e, t) {
                    var r = t.pluginSystem.hooks.eventSourceDefs;
                    return !r[e.sourceDefId].ignoreRange;
                }
                function Gr(e, t) {
                    for (var r = t.pluginSystem.hooks.eventSourceDefs, n = r.length - 1; n >= 0; n--) {
                        var i = r[n],
                            o = i.parseMeta(e);
                        if (o) {
                            var s = jr("object" == typeof e ? e : {}, o, n, t);
                            return (s._raw = ge(e)), s;
                        }
                    }
                    return null;
                }
                function jr(e, t, r, n) {
                    var i = {},
                        o = fe(e, Ur, {}, i),
                        s = {},
                        a = xt(i, n, s);
                    return (o.isFetching = !1), (o.latestFetchId = ""), (o.fetchRange = null), (o.publicId = String(e.id || "")), (o.sourceId = String(Wr++)), (o.sourceDefId = r), (o.meta = t), (o.ui = a), (o.extendedProps = s), o;
                }
                function Yr(e, t, r, n) {
                    switch (t.type) {
                        case "ADD_EVENT_SOURCES":
                            return (function (e, t, r, n) {
                                for (var i = {}, o = 0, s = t; o < s.length; o++) {
                                    var a = s[o];
                                    i[a.sourceId] = a;
                                }
                                return r && (i = Zr(i, r, n)), be({}, e, i);
                            })(e, t.sources, r ? r.activeRange : null, n);
                        case "REMOVE_EVENT_SOURCE":
                            return (
                                (i = e),
                                (o = t.sourceId),
                                Te(i, function (e) {
                                    return e.sourceId !== o;
                                })
                            );
                        case "PREV":
                        case "NEXT":
                        case "SET_DATE":
                        case "SET_VIEW_TYPE":
                            return r ? Zr(e, r.activeRange, n) : e;
                        case "FETCH_EVENT_SOURCES":
                        case "CHANGE_TIMEZONE":
                            return Xr(
                                e,
                                t.sourceIds
                                    ? Re(t.sourceIds)
                                    : (function (e, t) {
                                          return Te(e, function (e) {
                                              return Fr(e, t);
                                          });
                                      })(e, n),
                                r ? r.activeRange : null,
                                n
                            );
                        case "RECEIVE_EVENTS":
                        case "RECEIVE_EVENT_ERROR":
                            return (function (e, t, r, n) {
                                var i,
                                    o = e[t];
                                return o && r === o.latestFetchId ? be({}, e, (((i = {})[t] = be({}, o, { isFetching: !1, fetchRange: n })), i)) : e;
                            })(e, t.sourceId, t.fetchId, t.fetchRange);
                        case "REMOVE_ALL_EVENT_SOURCES":
                            return {};
                        default:
                            return e;
                    }
                    var i, o;
                }
                var qr = 0;
                function Zr(e, t, r) {
                    return Xr(
                        e,
                        Te(e, function (e) {
                            return (function (e, t, r) {
                                return Fr(e, r) ? !r.opt("lazyFetching") || !e.fetchRange || t.start < e.fetchRange.start || t.end > e.fetchRange.end : !e.latestFetchId;
                            })(e, t, r);
                        }),
                        t,
                        r
                    );
                }
                function Xr(e, t, r, n) {
                    var i = {};
                    for (var o in e) {
                        var s = e[o];
                        t[o] ? (i[o] = Jr(s, r, n)) : (i[o] = s);
                    }
                    return i;
                }
                function Jr(e, t, r) {
                    var n = r.pluginSystem.hooks.eventSourceDefs[e.sourceDefId],
                        i = String(qr++);
                    return (
                        n.fetch(
                            { eventSource: e, calendar: r, range: t },
                            function (n) {
                                var o,
                                    s,
                                    a = n.rawEvents,
                                    l = r.opt("eventSourceSuccess");
                                e.success && (s = e.success(a, n.xhr)), l && (o = l(a, n.xhr)), (a = s || o || a), r.dispatch({ type: "RECEIVE_EVENTS", sourceId: e.sourceId, fetchId: i, fetchRange: t, rawEvents: a });
                            },
                            function (n) {
                                var o = r.opt("eventSourceFailure");
                                console.warn(n.message, n), e.failure && e.failure(n), o && o(n), r.dispatch({ type: "RECEIVE_EVENT_ERROR", sourceId: e.sourceId, fetchId: i, fetchRange: t, error: n });
                            }
                        ),
                        be({}, e, { isFetching: !0, latestFetchId: i })
                    );
                }
                var Kr = (function () {
                    function e(e, t) {
                        (this.viewSpec = e), (this.options = e.options), (this.dateEnv = t.dateEnv), (this.calendar = t), this.initHiddenDays();
                    }
                    return (
                        (e.prototype.buildPrev = function (e, t) {
                            var r = this.dateEnv,
                                n = r.subtract(r.startOf(t, e.currentRangeUnit), e.dateIncrement);
                            return this.build(n, -1);
                        }),
                        (e.prototype.buildNext = function (e, t) {
                            var r = this.dateEnv,
                                n = r.add(r.startOf(t, e.currentRangeUnit), e.dateIncrement);
                            return this.build(n, 1);
                        }),
                        (e.prototype.build = function (e, t, r) {
                            var n;
                            void 0 === r && (r = !1);
                            var i,
                                o,
                                s,
                                a,
                                l,
                                c,
                                u,
                                d = null,
                                h = null;
                            return (
                                (n = this.buildValidRange()),
                                (n = this.trimHiddenDays(n)),
                                r && ((c = e), (e = null != (u = n).start && c < u.start ? u.start : null != u.end && c >= u.end ? new Date(u.end.valueOf() - 1) : c)),
                                (i = this.buildCurrentRangeInfo(e, t)),
                                (o = /^(year|month|week|day)$/.test(i.unit)),
                                (s = this.buildRenderRange(this.trimHiddenDays(i.range), i.unit, o)),
                                (s = this.trimHiddenDays(s)),
                                (a = s),
                                this.options.showNonCurrentDates || (a = Ae(a, i.range)),
                                (d = X(this.options.minTime)),
                                (h = X(this.options.maxTime)),
                                (a = Ae((a = this.adjustActiveRange(a, d, h)), n)),
                                (l = Ve(i.range, n)),
                                { validRange: n, currentRange: i.range, currentRangeUnit: i.unit, isRangeAllDay: o, activeRange: a, renderRange: s, minTime: d, maxTime: h, isValid: l, dateIncrement: this.buildDateIncrement(i.duration) }
                            );
                        }),
                        (e.prototype.buildValidRange = function () {
                            return this.getRangeOption("validRange", this.calendar.getNow()) || { start: null, end: null };
                        }),
                        (e.prototype.buildCurrentRangeInfo = function (e, t) {
                            var r,
                                n = this.viewSpec,
                                i = this.dateEnv,
                                o = null,
                                s = null,
                                a = null;
                            return (
                                n.duration
                                    ? ((o = n.duration), (s = n.durationUnit), (a = this.buildRangeFromDuration(e, t, o, s)))
                                    : (r = this.options.dayCount)
                                    ? ((s = "day"), (a = this.buildRangeFromDayCount(e, t, r)))
                                    : (a = this.buildCustomVisibleRange(e))
                                    ? (s = i.greatestWholeUnit(a.start, a.end).unit)
                                    : ((o = this.getFallbackDuration()), (s = re(o).unit), (a = this.buildRangeFromDuration(e, t, o, s))),
                                { duration: o, unit: s, range: a }
                            );
                        }),
                        (e.prototype.getFallbackDuration = function () {
                            return X({ day: 1 });
                        }),
                        (e.prototype.adjustActiveRange = function (e, t, r) {
                            var n = this.dateEnv,
                                i = e.start,
                                o = e.end;
                            return this.viewSpec.class.prototype.usesMinMaxTime && (ee(t) < 0 && ((i = A(i)), (i = n.add(i, t))), ee(r) > 1 && ((o = _((o = A(o)), -1)), (o = n.add(o, r)))), { start: i, end: o };
                        }),
                        (e.prototype.buildRangeFromDuration = function (e, t, r, n) {
                            var i,
                                o,
                                s,
                                a,
                                l,
                                c = this.dateEnv,
                                u = this.options.dateAlignment;
                            function d() {
                                (s = c.startOf(e, u)), (a = c.add(s, r)), (l = { start: s, end: a });
                            }
                            return (
                                u || ((i = this.options.dateIncrement) ? ((o = X(i)), (u = te(o) < te(r) ? re(o, !K(i)).unit : n)) : (u = n)),
                                ee(r) <= 1 && this.isHiddenDay(s) && (s = A((s = this.skipHiddenDays(s, t)))),
                                d(),
                                this.trimHiddenDays(l) || ((e = this.skipHiddenDays(e, t)), d()),
                                l
                            );
                        }),
                        (e.prototype.buildRangeFromDayCount = function (e, t, r) {
                            var n,
                                i = this.dateEnv,
                                o = this.options.dateAlignment,
                                s = 0,
                                a = e;
                            o && (a = i.startOf(a, o)), (a = A(a)), (a = this.skipHiddenDays(a, t)), (n = a);
                            do {
                                (n = _(n, 1)), this.isHiddenDay(n) || s++;
                            } while (s < r);
                            return { start: a, end: n };
                        }),
                        (e.prototype.buildCustomVisibleRange = function (e) {
                            var t = this.dateEnv,
                                r = this.getRangeOption("visibleRange", t.toDate(e));
                            return !r || (null != r.start && null != r.end) ? r : null;
                        }),
                        (e.prototype.buildRenderRange = function (e, t, r) {
                            return e;
                        }),
                        (e.prototype.buildDateIncrement = function (e) {
                            var t,
                                r = this.options.dateIncrement;
                            return r ? X(r) : (t = this.options.dateAlignment) ? X(1, t) : e || X({ days: 1 });
                        }),
                        (e.prototype.getRangeOption = function (e) {
                            for (var t = [], r = 1; r < arguments.length; r++) t[r - 1] = arguments[r];
                            var n,
                                i,
                                o,
                                s,
                                a = this.options[e];
                            return (
                                "function" == typeof a && (a = a.apply(null, t)),
                                a &&
                                    ((n = a),
                                    (i = this.dateEnv),
                                    (o = null),
                                    (s = null),
                                    n.start && (o = i.createMarker(n.start)),
                                    n.end && (s = i.createMarker(n.end)),
                                    (a = o || s ? (o && s && s < o ? null : { start: o, end: s }) : null)),
                                a && (a = me(a)),
                                a
                            );
                        }),
                        (e.prototype.initHiddenDays = function () {
                            var e,
                                t = this.options.hiddenDays || [],
                                r = [],
                                n = 0;
                            for (!1 === this.options.weekends && t.push(0, 6), e = 0; e < 7; e++) (r[e] = -1 !== t.indexOf(e)) || n++;
                            if (!n) throw new Error("invalid hiddenDays");
                            this.isHiddenDayHash = r;
                        }),
                        (e.prototype.trimHiddenDays = function (e) {
                            var t = e.start,
                                r = e.end;
                            return t && (t = this.skipHiddenDays(t)), r && (r = this.skipHiddenDays(r, -1, !0)), null == t || null == r || t < r ? { start: t, end: r } : null;
                        }),
                        (e.prototype.isHiddenDay = function (e) {
                            return e instanceof Date && (e = e.getUTCDay()), this.isHiddenDayHash[e];
                        }),
                        (e.prototype.skipHiddenDays = function (e, t, r) {
                            for (void 0 === t && (t = 1), void 0 === r && (r = !1); this.isHiddenDayHash[(e.getUTCDay() + (r ? t : 0) + 7) % 7]; ) e = _(e, t);
                            return e;
                        }),
                        e
                    );
                })();
                function Qr(e, t, r) {
                    for (
                        var n = (function (e, t) {
                                switch (t.type) {
                                    case "SET_VIEW_TYPE":
                                        return t.viewType;
                                    default:
                                        return e;
                                }
                            })(e.viewType, t),
                            i = (function (e, t, r, n, i) {
                                var o, s, a;
                                switch (t.type) {
                                    case "PREV":
                                        o = i.dateProfileGenerators[n].buildPrev(e, r);
                                        break;
                                    case "NEXT":
                                        o = i.dateProfileGenerators[n].buildNext(e, r);
                                        break;
                                    case "SET_DATE":
                                        (e.activeRange && We(e.currentRange, t.dateMarker)) || (o = i.dateProfileGenerators[n].build(t.dateMarker, void 0, !0));
                                        break;
                                    case "SET_VIEW_TYPE":
                                        var l = i.dateProfileGenerators[n];
                                        if (!l) throw new Error(n ? 'The FullCalendar view "' + n + '" does not exist. Make sure your plugins are loaded correctly.' : "No available FullCalendar view plugins.");
                                        o = l.build(t.dateMarker || r, void 0, !0);
                                }
                                return !o || !o.isValid || (e && ((a = o), Be((s = e).activeRange, a.activeRange) && Be(s.validRange, a.validRange) && Q(s.minTime, a.minTime) && Q(s.maxTime, a.maxTime))) ? e : o;
                            })(e.dateProfile, t, e.currentDate, n, r),
                            o = Yr(e.eventSources, t, i, r),
                            s = be({}, e, {
                                viewType: n,
                                dateProfile: i,
                                currentDate: $r(e.currentDate, t, i),
                                eventSources: o,
                                eventStore: St(e.eventStore, t, o, i, r),
                                dateSelection: en(e.dateSelection, t, r),
                                eventSelection: tn(e.eventSelection, t),
                                eventDrag: rn(e.eventDrag, t, o, r),
                                eventResize: nn(e.eventResize, t, o, r),
                                eventSourceLoadingLevel: on(o),
                                loadingLevel: on(o),
                            }),
                            a = 0,
                            l = r.pluginSystem.hooks.reducers;
                        a < l.length;
                        a++
                    ) {
                        var c = l[a];
                        s = c(s, t, r);
                    }
                    return s;
                }
                function $r(e, t, r) {
                    switch (t.type) {
                        case "PREV":
                        case "NEXT":
                            return We(r.currentRange, e) ? e : r.currentRange.start;
                        case "SET_DATE":
                        case "SET_VIEW_TYPE":
                            var n = t.dateMarker || e;
                            return r.activeRange && !We(r.activeRange, n) ? r.currentRange.start : n;
                        default:
                            return e;
                    }
                }
                function en(e, t, r) {
                    switch (t.type) {
                        case "SELECT_DATES":
                            return t.selection;
                        case "UNSELECT_DATES":
                            return null;
                        default:
                            return e;
                    }
                }
                function tn(e, t) {
                    switch (t.type) {
                        case "SELECT_EVENT":
                            return t.eventInstanceId;
                        case "UNSELECT_EVENT":
                            return "";
                        default:
                            return e;
                    }
                }
                function rn(e, t, r, n) {
                    switch (t.type) {
                        case "SET_EVENT_DRAG":
                            var i = t.state;
                            return { affectedEvents: i.affectedEvents, mutatedEvents: i.mutatedEvents, isEvent: i.isEvent, origSeg: i.origSeg };
                        case "UNSET_EVENT_DRAG":
                            return null;
                        default:
                            return e;
                    }
                }
                function nn(e, t, r, n) {
                    switch (t.type) {
                        case "SET_EVENT_RESIZE":
                            var i = t.state;
                            return { affectedEvents: i.affectedEvents, mutatedEvents: i.mutatedEvents, isEvent: i.isEvent, origSeg: i.origSeg };
                        case "UNSET_EVENT_RESIZE":
                            return null;
                        default:
                            return e;
                    }
                }
                function on(e) {
                    var t = 0;
                    for (var r in e) e[r].isFetching && t++;
                    return t;
                }
                var sn = { start: null, end: null, allDay: Boolean };
                function an(e, t, r) {
                    var n = (function (e, t) {
                            var r = {},
                                n = fe(e, sn, {}, r),
                                i = n.start ? t.createMarkerMeta(n.start) : null,
                                o = n.end ? t.createMarkerMeta(n.end) : null,
                                s = n.allDay;
                            return null == s && (s = i && i.isTimeUnspecified && (!o || o.isTimeUnspecified)), (r.range = { start: i ? i.marker : null, end: o ? o.marker : null }), (r.allDay = s), r;
                        })(e, t),
                        i = n.range;
                    if (!i.start) return null;
                    if (!i.end) {
                        if (null == r) return null;
                        i.end = t.add(i.start, r);
                    }
                    return n;
                }
                function ln(e, t, r, n) {
                    if (t[e]) return t[e];
                    var i = (function (e, t, r, n) {
                        var i = r[e],
                            o = n[e],
                            s = function (e) {
                                return i && null !== i[e] ? i[e] : o && null !== o[e] ? o[e] : null;
                            },
                            a = s("class"),
                            l = s("superType");
                        !l && a && (l = cn(a, n) || cn(a, r));
                        var c = l ? ln(l, t, r, n) : null;
                        return !a && c && (a = c.class), a ? { type: e, class: a, defaults: be({}, c ? c.defaults : {}, i ? i.options : {}), overrides: be({}, c ? c.overrides : {}, o ? o.options : {}) } : null;
                    })(e, t, r, n);
                    return i && (t[e] = i), i;
                }
                function cn(e, t) {
                    var r = Object.getPrototypeOf(e.prototype);
                    for (var n in t) {
                        var i = t[n];
                        if (i.class && i.class.prototype === r) return n;
                    }
                    return "";
                }
                function un(e) {
                    return Ce(e, hn);
                }
                var dn = { type: String, class: null };
                function hn(e) {
                    "function" == typeof e && (e = { class: e });
                    var t = {},
                        r = fe(e, dn, {}, t);
                    return { superType: r.type, class: r.class, options: t };
                }
                function pn(e, t) {
                    var r = un(e),
                        n = un(t.overrides.views),
                        i = (function (e, t) {
                            var r,
                                n = {};
                            for (r in e) ln(r, n, e, t);
                            for (r in t) ln(r, n, e, t);
                            return n;
                        })(r, n);
                    return Ce(i, function (e) {
                        return (function (e, t, r) {
                            var n = e.overrides.duration || e.defaults.duration || r.dynamicOverrides.duration || r.overrides.duration,
                                i = null,
                                o = "",
                                s = "",
                                a = {};
                            if (n && (i = X(n))) {
                                var l = re(i, !K(n));
                                (o = l.unit), 1 === l.value && ((s = o), (a = t[o] ? t[o].options : {}));
                            }
                            var c = function (t) {
                                var r = t.buttonText || {},
                                    n = e.defaults.buttonTextKey;
                                return null != n && null != r[n] ? r[n] : null != r[e.type] ? r[e.type] : null != r[s] ? r[s] : void 0;
                            };
                            return {
                                type: e.type,
                                class: e.class,
                                duration: i,
                                durationUnit: o,
                                singleUnit: s,
                                options: be({}, Cr, e.defaults, r.dirDefaults, r.localeDefaults, r.overrides, a, e.overrides, r.dynamicOverrides),
                                buttonTextOverride: c(r.dynamicOverrides) || c(r.overrides) || e.overrides.buttonText,
                                buttonTextDefault: c(r.localeDefaults) || c(r.dirDefaults) || e.defaults.buttonText || c(Cr) || e.type,
                            };
                        })(e, n, t);
                    });
                }
                var fn = (function (e) {
                        function t(t, r) {
                            var i = e.call(this, t) || this;
                            return (
                                (i._renderLayout = Yt(i.renderLayout, i.unrenderLayout)),
                                (i._updateTitle = Yt(i.updateTitle, null, [i._renderLayout])),
                                (i._updateActiveButton = Yt(i.updateActiveButton, null, [i._renderLayout])),
                                (i._updateToday = Yt(i.updateToday, null, [i._renderLayout])),
                                (i._updatePrev = Yt(i.updatePrev, null, [i._renderLayout])),
                                (i._updateNext = Yt(i.updateNext, null, [i._renderLayout])),
                                (i.el = n("div", { className: "fc-toolbar " + r })),
                                i
                            );
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this._renderLayout.unrender(), u(this.el);
                            }),
                            (t.prototype.render = function (e) {
                                this._renderLayout(e.layout), this._updateTitle(e.title), this._updateActiveButton(e.activeButton), this._updateToday(e.isTodayEnabled), this._updatePrev(e.isPrevEnabled), this._updateNext(e.isNextEnabled);
                            }),
                            (t.prototype.renderLayout = function (e) {
                                var t = this.el;
                                (this.viewsWithButtons = []), a(t, this.renderSection("left", e.left)), a(t, this.renderSection("center", e.center)), a(t, this.renderSection("right", e.right));
                            }),
                            (t.prototype.unrenderLayout = function () {
                                this.el.innerHTML = "";
                            }),
                            (t.prototype.renderSection = function (e, t) {
                                var r = this,
                                    o = this.theme,
                                    s = this.calendar,
                                    l = s.optionsManager,
                                    c = s.viewSpecs,
                                    u = n("div", { className: "fc-" + e }),
                                    d = l.computed.customButtons || {},
                                    h = l.overrides.buttonText || {},
                                    p = l.computed.buttonText || {};
                                return (
                                    t &&
                                        t.split(" ").forEach(function (e, t) {
                                            var n,
                                                l = [],
                                                f = !0;
                                            if (
                                                (e.split(",").forEach(function (e, t) {
                                                    var n, a, u, g, v, m, y, S, E;
                                                    "title" === e
                                                        ? (l.push(i("<h2>&nbsp;</h2>")), (f = !1))
                                                        : ((n = d[e])
                                                              ? ((u = function (e) {
                                                                    n.click && n.click.call(S, e);
                                                                }),
                                                                (g = o.getCustomButtonIconClass(n)) || (g = o.getIconClass(e)) || (v = n.text))
                                                              : (a = c[e])
                                                              ? (r.viewsWithButtons.push(e),
                                                                (u = function () {
                                                                    s.changeView(e);
                                                                }),
                                                                (v = a.buttonTextOverride) || (g = o.getIconClass(e)) || (v = a.buttonTextDefault))
                                                              : s[e] &&
                                                                ((u = function () {
                                                                    s[e]();
                                                                }),
                                                                (v = h[e]) || (g = o.getIconClass(e)) || (v = p[e])),
                                                          u &&
                                                              ((y = ["fc-" + e + "-button", o.getClass("button")]),
                                                              v ? ((m = Pt(v)), (E = "")) : g && ((m = "<span class='" + g + "'></span>"), (E = ' aria-label="' + e + '"')),
                                                              (S = i('<button type="button" class="' + y.join(" ") + '"' + E + ">" + m + "</button>")).addEventListener("click", u),
                                                              l.push(S)));
                                                }),
                                                l.length > 1)
                                            ) {
                                                n = document.createElement("div");
                                                var g = o.getClass("buttonGroup");
                                                f && g && n.classList.add(g), a(n, l), u.appendChild(n);
                                            } else a(u, l);
                                        }),
                                    u
                                );
                            }),
                            (t.prototype.updateToday = function (e) {
                                this.toggleButtonEnabled("today", e);
                            }),
                            (t.prototype.updatePrev = function (e) {
                                this.toggleButtonEnabled("prev", e);
                            }),
                            (t.prototype.updateNext = function (e) {
                                this.toggleButtonEnabled("next", e);
                            }),
                            (t.prototype.updateTitle = function (e) {
                                g(this.el, "h2").forEach(function (t) {
                                    t.innerText = e;
                                });
                            }),
                            (t.prototype.updateActiveButton = function (e) {
                                var t = this.theme.getClass("buttonActive");
                                g(this.el, "button").forEach(function (r) {
                                    e && r.classList.contains("fc-" + e + "-button") ? r.classList.add(t) : r.classList.remove(t);
                                });
                            }),
                            (t.prototype.toggleButtonEnabled = function (e, t) {
                                g(this.el, ".fc-" + e + "-button").forEach(function (e) {
                                    e.disabled = !t;
                                });
                            }),
                            t
                        );
                    })(hr),
                    gn = (function (e) {
                        function t(t, r) {
                            var i = e.call(this, t) || this;
                            (i._renderToolbars = Yt(i.renderToolbars)), (i.buildViewPropTransformers = Ge(mn)), (i.el = r), l(r, (i.contentEl = n("div", { className: "fc-view-container" })));
                            for (var o = i.calendar, s = 0, a = o.pluginSystem.hooks.viewContainerModifiers; s < a.length; s++) {
                                var c = a[s];
                                c(i.contentEl, o);
                            }
                            return (
                                i.toggleElClassNames(!0),
                                (i.computeTitle = Ge(vn)),
                                (i.parseBusinessHours = Ge(function (e) {
                                    return jt(e, i.calendar);
                                })),
                                i
                            );
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.destroy = function () {
                                this.header && this.header.destroy(), this.footer && this.footer.destroy(), this.view && this.view.destroy(), u(this.contentEl), this.toggleElClassNames(!1), e.prototype.destroy.call(this);
                            }),
                            (t.prototype.toggleElClassNames = function (e) {
                                var t = this.el.classList,
                                    r = "fc-" + this.opt("dir"),
                                    n = this.theme.getClass("widget");
                                e ? (t.add("fc"), t.add(r), t.add(n)) : (t.remove("fc"), t.remove(r), t.remove(n));
                            }),
                            (t.prototype.render = function (e) {
                                this.freezeHeight();
                                var t = this.computeTitle(e.dateProfile, e.viewSpec.options);
                                this._renderToolbars(e.viewSpec, e.dateProfile, e.currentDate, e.dateProfileGenerator, t), this.renderView(e, t), this.updateSize(), this.thawHeight();
                            }),
                            (t.prototype.renderToolbars = function (e, t, r, n, i) {
                                var o = this.opt("header"),
                                    s = this.opt("footer"),
                                    c = this.calendar.getNow(),
                                    u = n.build(c),
                                    d = n.buildPrev(t, r),
                                    h = n.buildNext(t, r),
                                    p = { title: i, activeButton: e.type, isTodayEnabled: u.isValid && !We(t.currentRange, c), isPrevEnabled: d.isValid, isNextEnabled: h.isValid };
                                o
                                    ? (this.header || ((this.header = new fn(this.context, "fc-header-toolbar")), l(this.el, this.header.el)), this.header.receiveProps(be({ layout: o }, p)))
                                    : this.header && (this.header.destroy(), (this.header = null)),
                                    s
                                        ? (this.footer || ((this.footer = new fn(this.context, "fc-footer-toolbar")), a(this.el, this.footer.el)), this.footer.receiveProps(be({ layout: s }, p)))
                                        : this.footer && (this.footer.destroy(), (this.footer = null));
                            }),
                            (t.prototype.renderView = function (e, t) {
                                var r = this.view,
                                    n = e.viewSpec,
                                    i = e.dateProfileGenerator;
                                r && r.viewSpec === n
                                    ? r.addScroll(r.queryScroll())
                                    : (r && r.destroy(), (r = this.view = new n.class({ calendar: this.calendar, view: null, dateEnv: this.dateEnv, theme: this.theme, options: n.options }, n, i, this.contentEl))),
                                    (r.title = t);
                                for (
                                    var o = {
                                            dateProfile: e.dateProfile,
                                            businessHours: this.parseBusinessHours(n.options.businessHours),
                                            eventStore: e.eventStore,
                                            eventUiBases: e.eventUiBases,
                                            dateSelection: e.dateSelection,
                                            eventSelection: e.eventSelection,
                                            eventDrag: e.eventDrag,
                                            eventResize: e.eventResize,
                                        },
                                        s = this.buildViewPropTransformers(this.calendar.pluginSystem.hooks.viewPropsTransformers),
                                        a = 0,
                                        l = s;
                                    a < l.length;
                                    a++
                                ) {
                                    var c = l[a];
                                    be(o, c.transform(o, n, e, r));
                                }
                                r.receiveProps(o);
                            }),
                            (t.prototype.updateSize = function (e) {
                                void 0 === e && (e = !1);
                                var t = this.view;
                                e && t.addScroll(t.queryScroll()), (e || null == this.isHeightAuto) && this.computeHeightVars(), t.updateSize(e, this.viewHeight, this.isHeightAuto), t.updateNowIndicator(), t.popScroll(e);
                            }),
                            (t.prototype.computeHeightVars = function () {
                                var e = this.calendar,
                                    t = e.opt("height"),
                                    r = e.opt("contentHeight");
                                (this.isHeightAuto = "auto" === t || "auto" === r),
                                    (this.viewHeight =
                                        "number" == typeof r
                                            ? r
                                            : "function" == typeof r
                                            ? r()
                                            : "number" == typeof t
                                            ? t - this.queryToolbarsHeight()
                                            : "function" == typeof t
                                            ? t() - this.queryToolbarsHeight()
                                            : "parent" === t
                                            ? this.el.parentNode.offsetHeight - this.queryToolbarsHeight()
                                            : Math.round(this.contentEl.offsetWidth / Math.max(e.opt("aspectRatio"), 0.5)));
                            }),
                            (t.prototype.queryToolbarsHeight = function () {
                                var e = 0;
                                return this.header && (e += R(this.header.el)), this.footer && (e += R(this.footer.el)), e;
                            }),
                            (t.prototype.freezeHeight = function () {
                                m(this.el, { height: this.el.offsetHeight, overflow: "hidden" });
                            }),
                            (t.prototype.thawHeight = function () {
                                m(this.el, { height: "", overflow: "" });
                            }),
                            t
                        );
                    })(hr);
                function vn(e, t) {
                    var r;
                    return (
                        (r = /^(year|month)$/.test(e.currentRangeUnit) ? e.currentRange : e.activeRange),
                        this.dateEnv.formatRange(
                            r.start,
                            r.end,
                            nt(
                                t.titleFormat ||
                                    (function (e) {
                                        var t = e.currentRangeUnit;
                                        if ("year" === t) return { year: "numeric" };
                                        if ("month" === t) return { year: "numeric", month: "long" };
                                        var r = N(e.currentRange.start, e.currentRange.end);
                                        return null !== r && r > 1 ? { year: "numeric", month: "short", day: "numeric" } : { year: "numeric", month: "long", day: "numeric" };
                                    })(e),
                                t.titleRangeSeparator
                            ),
                            { isEndExclusive: e.isRangeAllDay }
                        )
                    );
                }
                function mn(e) {
                    return e.map(function (e) {
                        return new e();
                    });
                }
                var yn = (function () {
                        function e(e) {
                            this.component = e.component;
                        }
                        return (e.prototype.destroy = function () {}), e;
                    })(),
                    Sn = {},
                    En = (function (e) {
                        function t(t) {
                            var r = e.call(this, t) || this;
                            r.handleSegClick = function (e, t) {
                                var n = r.component,
                                    i = ht(t);
                                if (i && n.isValidSegDownEl(e.target)) {
                                    var o = p(e.target, ".fc-has-url"),
                                        s = o ? o.querySelector("a[href]").href : "";
                                    n.publiclyTrigger("eventClick", [{ el: t, event: new lt(n.calendar, i.eventRange.def, i.eventRange.instance), jsEvent: e, view: n.view }]), s && !e.defaultPrevented && (window.location.href = s);
                                }
                            };
                            var n = t.component;
                            return (r.destroy = P(n.el, "click", n.fgSegSelector + "," + n.bgSegSelector, r.handleSegClick)), r;
                        }
                        return Ee(t, e), t;
                    })(yn),
                    bn = (function (e) {
                        function t(t) {
                            var r = e.call(this, t) || this;
                            (r.handleEventElRemove = function (e) {
                                e === r.currentSegEl && r.handleSegLeave(null, r.currentSegEl);
                            }),
                                (r.handleSegEnter = function (e, t) {
                                    ht(t) && (t.classList.add("fc-allow-mouse-resize"), (r.currentSegEl = t), r.triggerEvent("eventMouseEnter", e, t));
                                }),
                                (r.handleSegLeave = function (e, t) {
                                    r.currentSegEl && (t.classList.remove("fc-allow-mouse-resize"), (r.currentSegEl = null), r.triggerEvent("eventMouseLeave", e, t));
                                });
                            var n,
                                i,
                                o,
                                s,
                                a,
                                l = t.component;
                            return (
                                (r.removeHoverListeners =
                                    ((n = l.el),
                                    (i = l.fgSegSelector + "," + l.bgSegSelector),
                                    (o = r.handleSegEnter),
                                    (s = r.handleSegLeave),
                                    P(n, "mouseover", i, function (e, t) {
                                        if (t !== a) {
                                            (a = t), o(e, t);
                                            var r = function (e) {
                                                (a = null), s(e, t), t.removeEventListener("mouseleave", r);
                                            };
                                            t.addEventListener("mouseleave", r);
                                        }
                                    }))),
                                l.calendar.on("eventElRemove", r.handleEventElRemove),
                                r
                            );
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.destroy = function () {
                                this.removeHoverListeners(), this.component.calendar.off("eventElRemove", this.handleEventElRemove);
                            }),
                            (t.prototype.triggerEvent = function (e, t, r) {
                                var n = this.component,
                                    i = ht(r);
                                (t && !n.isValidSegDownEl(t.target)) || n.publiclyTrigger(e, [{ el: r, event: new lt(this.component.calendar, i.eventRange.def, i.eventRange.instance), jsEvent: t, view: n.view }]);
                            }),
                            t
                        );
                    })(yn),
                    Dn = (function (e) {
                        function t() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return Ee(t, e), t;
                    })(ur);
                (Dn.prototype.classes = {
                    widget: "fc-unthemed",
                    widgetHeader: "fc-widget-header",
                    widgetContent: "fc-widget-content",
                    buttonGroup: "fc-button-group",
                    button: "fc-button fc-button-primary",
                    buttonActive: "fc-button-active",
                    popoverHeader: "fc-widget-header",
                    popoverContent: "fc-widget-content",
                    headerRow: "fc-widget-header",
                    dayRow: "fc-widget-content",
                    listView: "fc-widget-content",
                }),
                    (Dn.prototype.baseIconClass = "fc-icon"),
                    (Dn.prototype.iconClasses = { close: "fc-icon-x", prev: "fc-icon-chevron-left", next: "fc-icon-chevron-right", prevYear: "fc-icon-chevrons-left", nextYear: "fc-icon-chevrons-right" }),
                    (Dn.prototype.iconOverrideOption = "buttonIcons"),
                    (Dn.prototype.iconOverrideCustomButtonOption = "icon"),
                    (Dn.prototype.iconOverridePrefix = "fc-icon-");
                var wn = (function () {
                    function e(e, t) {
                        var r = this;
                        (this.parseRawLocales = Ge(Hr)),
                            (this.buildLocale = Ge(kr)),
                            (this.buildDateEnv = Ge(Tn)),
                            (this.buildTheme = Ge(Cn)),
                            (this.buildEventUiSingleBase = Ge(this._buildEventUiSingleBase)),
                            (this.buildSelectionConfig = Ge(this._buildSelectionConfig)),
                            (this.buildEventUiBySource = je(In, Zt)),
                            (this.buildEventUiBases = Ge(Mn)),
                            (this.interactionsStore = {}),
                            (this.actionQueue = []),
                            (this.isReducing = !1),
                            (this.needsRerender = !1),
                            (this.needsFullRerender = !1),
                            (this.isRendering = !1),
                            (this.renderingPauseDepth = 0),
                            (this.buildDelayedRerender = Ge(Rn)),
                            (this.afterSizingTriggers = {}),
                            (this.isViewUpdated = !1),
                            (this.isDatesUpdated = !1),
                            (this.isEventsUpdated = !1),
                            (this.el = e),
                            (this.optionsManager = new zr(t || {})),
                            (this.pluginSystem = new vr()),
                            this.addPluginInputs(this.optionsManager.computed.plugins || []),
                            this.handleOptions(this.optionsManager.computed),
                            this.publiclyTrigger("_init"),
                            this.hydrate(),
                            (this.calendarInteractions = this.pluginSystem.hooks.calendarInteractions.map(function (e) {
                                return new e(r);
                            }));
                    }
                    return (
                        (e.prototype.addPluginInputs = function (e) {
                            for (
                                var t = (function (e) {
                                        for (var t = [], r = 0, n = e; r < n.length; r++) {
                                            var i = n[r];
                                            if ("string" == typeof i) {
                                                var o = "FullCalendar" + le(i);
                                                window[o] ? t.push(window[o].default) : console.warn("Plugin file not loaded for " + i);
                                            } else t.push(i);
                                        }
                                        return Mr.concat(t);
                                    })(e),
                                    r = 0,
                                    n = t;
                                r < n.length;
                                r++
                            ) {
                                var i = n[r];
                                this.pluginSystem.add(i);
                            }
                        }),
                        Object.defineProperty(e.prototype, "view", {
                            get: function () {
                                return this.component ? this.component.view : null;
                            },
                            enumerable: !0,
                            configurable: !0,
                        }),
                        (e.prototype.render = function () {
                            this.component ? this.requestRerender(!0) : ((this.renderableEventStore = { defs: {}, instances: {} }), this.bindHandlers(), this.executeRender());
                        }),
                        (e.prototype.destroy = function () {
                            if (this.component) {
                                this.unbindHandlers(), this.component.destroy(), (this.component = null);
                                for (var e = 0, t = this.calendarInteractions; e < t.length; e++) {
                                    var r = t[e];
                                    r.destroy();
                                }
                                this.publiclyTrigger("_destroyed");
                            }
                        }),
                        (e.prototype.bindHandlers = function () {
                            var e = this;
                            (this.removeNavLinkListener = P(this.el, "click", "a[data-goto]", function (t, r) {
                                var n = r.getAttribute("data-goto");
                                n = n ? JSON.parse(n) : {};
                                var i = e.dateEnv,
                                    o = i.createMarker(n.date),
                                    s = n.type,
                                    a = e.viewOpt("navLink" + le(s) + "Click");
                                "function" == typeof a ? a(i.toDate(o), t) : ("string" == typeof a && (s = a), e.zoomTo(o, s));
                            })),
                                this.opt("handleWindowResize") && window.addEventListener("resize", (this.windowResizeProxy = pe(this.windowResize.bind(this), this.opt("windowResizeDelay"))));
                        }),
                        (e.prototype.unbindHandlers = function () {
                            this.removeNavLinkListener(), this.windowResizeProxy && (window.removeEventListener("resize", this.windowResizeProxy), (this.windowResizeProxy = null));
                        }),
                        (e.prototype.hydrate = function () {
                            var e = this;
                            this.state = this.buildInitialState();
                            var t = this.opt("eventSources") || [],
                                r = this.opt("events"),
                                n = [];
                            r && t.unshift(r);
                            for (var i = 0, o = t; i < o.length; i++) {
                                var s = o[i],
                                    a = Gr(s, this);
                                a && n.push(a);
                            }
                            this.batchRendering(function () {
                                e.dispatch({ type: "INIT" }), e.dispatch({ type: "ADD_EVENT_SOURCES", sources: n }), e.dispatch({ type: "SET_VIEW_TYPE", viewType: e.opt("defaultView") || e.pluginSystem.hooks.defaultView });
                            });
                        }),
                        (e.prototype.buildInitialState = function () {
                            return {
                                viewType: null,
                                loadingLevel: 0,
                                eventSourceLoadingLevel: 0,
                                currentDate: this.getInitialDate(),
                                dateProfile: null,
                                eventSources: {},
                                eventStore: { defs: {}, instances: {} },
                                dateSelection: null,
                                eventSelection: "",
                                eventDrag: null,
                                eventResize: null,
                            };
                        }),
                        (e.prototype.dispatch = function (e) {
                            if ((this.actionQueue.push(e), !this.isReducing)) {
                                this.isReducing = !0;
                                for (var t = this.state; this.actionQueue.length; ) this.state = this.reduce(this.state, this.actionQueue.shift(), this);
                                var r = this.state;
                                (this.isReducing = !1), !t.loadingLevel && r.loadingLevel ? this.publiclyTrigger("loading", [!0]) : t.loadingLevel && !r.loadingLevel && this.publiclyTrigger("loading", [!1]);
                                var n = this.component && this.component.view;
                                (t.eventStore !== r.eventStore || this.needsFullRerender) && t.eventStore && (this.isEventsUpdated = !0),
                                    (t.dateProfile !== r.dateProfile || this.needsFullRerender) && (t.dateProfile && n && this.publiclyTrigger("datesDestroy", [{ view: n, el: n.el }]), (this.isDatesUpdated = !0)),
                                    (t.viewType !== r.viewType || this.needsFullRerender) && (t.viewType && n && this.publiclyTrigger("viewSkeletonDestroy", [{ view: n, el: n.el }]), (this.isViewUpdated = !0)),
                                    this.requestRerender();
                            }
                        }),
                        (e.prototype.reduce = function (e, t, r) {
                            return Qr(e, t, r);
                        }),
                        (e.prototype.requestRerender = function (e) {
                            void 0 === e && (e = !1), (this.needsRerender = !0), (this.needsFullRerender = this.needsFullRerender || e), this.delayedRerender();
                        }),
                        (e.prototype.tryRerender = function () {
                            this.component && this.needsRerender && !this.renderingPauseDepth && !this.isRendering && this.executeRender();
                        }),
                        (e.prototype.batchRendering = function (e) {
                            this.renderingPauseDepth++, e(), this.renderingPauseDepth--, this.needsRerender && this.requestRerender();
                        }),
                        (e.prototype.executeRender = function () {
                            var e = this.needsFullRerender;
                            (this.needsRerender = !1), (this.needsFullRerender = !1), (this.isRendering = !0), this.renderComponent(e), (this.isRendering = !1), this.needsRerender && this.delayedRerender();
                        }),
                        (e.prototype.renderComponent = function (e) {
                            var t = this.state,
                                r = this.component,
                                n = t.viewType,
                                i = this.viewSpecs[n],
                                o = e && r ? r.view.queryScroll() : null;
                            if (!i) throw new Error('View type "' + n + '" is not valid');
                            var s = (this.renderableEventStore = t.eventSourceLoadingLevel && !this.opt("progressiveEventRendering") ? this.renderableEventStore : t.eventStore),
                                a = this.buildEventUiSingleBase(i.options),
                                l = this.buildEventUiBySource(t.eventSources),
                                c = (this.eventUiBases = this.buildEventUiBases(s.defs, a, l));
                            (!e && r) || (r && (r.freezeHeight(), r.destroy()), (r = this.component = new gn({ calendar: this, view: null, dateEnv: this.dateEnv, theme: this.theme, options: this.optionsManager.computed }, this.el))),
                                r.receiveProps(
                                    be({}, t, {
                                        viewSpec: i,
                                        dateProfile: t.dateProfile,
                                        dateProfileGenerator: this.dateProfileGenerators[n],
                                        eventStore: s,
                                        eventUiBases: c,
                                        dateSelection: t.dateSelection,
                                        eventSelection: t.eventSelection,
                                        eventDrag: t.eventDrag,
                                        eventResize: t.eventResize,
                                    })
                                ),
                                o && r.view.applyScroll(o, !1),
                                this.isViewUpdated && ((this.isViewUpdated = !1), this.publiclyTrigger("viewSkeletonRender", [{ view: r.view, el: r.view.el }])),
                                this.isDatesUpdated && ((this.isDatesUpdated = !1), this.publiclyTrigger("datesRender", [{ view: r.view, el: r.view.el }])),
                                this.isEventsUpdated && (this.isEventsUpdated = !1),
                                this.releaseAfterSizingTriggers();
                        }),
                        (e.prototype.resetOptions = function (e) {
                            var t = this,
                                r = this.pluginSystem.hooks.optionChangeHandlers,
                                n = this.optionsManager.overrides,
                                i = {},
                                o = {},
                                s = {};
                            for (var a in n) r[a] || (i[a] = n[a]);
                            for (var l in e) r[l] ? (s[l] = e[l]) : (o[l] = e[l]);
                            this.batchRendering(function () {
                                for (var n in ((function (e, t) {
                                    for (var r in e) if (!(r in t)) return !0;
                                    return !1;
                                })(i, o)
                                    ? t.processOptions(e, "reset")
                                    : t.processOptions(
                                          (function (e, t, r) {
                                              void 0 === r && (r = 1);
                                              var n = {};
                                              for (var i in t) (i in e && qt(e[i], t[i], r - 1)) || (n[i] = t[i]);
                                              return n;
                                          })(i, o)
                                      ),
                                s))
                                    r[n](s[n], t);
                            });
                        }),
                        (e.prototype.setOptions = function (e) {
                            var t = this,
                                r = this.pluginSystem.hooks.optionChangeHandlers,
                                n = {},
                                i = {};
                            for (var o in e) r[o] ? (i[o] = e[o]) : (n[o] = e[o]);
                            this.batchRendering(function () {
                                for (var e in (t.processOptions(n), i)) r[e](i[e], t);
                            });
                        }),
                        (e.prototype.processOptions = function (e, t) {
                            var r = this,
                                n = this.dateEnv,
                                i = !1,
                                o = !1,
                                s = !1;
                            for (var a in e) /^(height|contentHeight|aspectRatio)$/.test(a) ? (o = !0) : /^(defaultDate|defaultView)$/.test(a) || ((s = !0), "timeZone" === a && (i = !0));
                            "reset" === t ? ((s = !0), this.optionsManager.reset(e)) : "dynamic" === t ? this.optionsManager.addDynamic(e) : this.optionsManager.add(e),
                                s &&
                                    (this.handleOptions(this.optionsManager.computed),
                                    (this.needsFullRerender = !0),
                                    this.batchRendering(function () {
                                        i && r.dispatch({ type: "CHANGE_TIMEZONE", oldDateEnv: n }), r.dispatch({ type: "SET_VIEW_TYPE", viewType: r.state.viewType });
                                    })),
                                o && this.updateSize();
                        }),
                        (e.prototype.setOption = function (e, t) {
                            var r;
                            this.processOptions((((r = {})[e] = t), r), "dynamic");
                        }),
                        (e.prototype.getOption = function (e) {
                            return this.optionsManager.computed[e];
                        }),
                        (e.prototype.opt = function (e) {
                            return this.optionsManager.computed[e];
                        }),
                        (e.prototype.viewOpt = function (e) {
                            return this.viewOpts()[e];
                        }),
                        (e.prototype.viewOpts = function () {
                            return this.viewSpecs[this.state.viewType].options;
                        }),
                        (e.prototype.handleOptions = function (e) {
                            var t = this,
                                r = this.pluginSystem.hooks;
                            (this.defaultAllDayEventDuration = X(e.defaultAllDayEventDuration)),
                                (this.defaultTimedEventDuration = X(e.defaultTimedEventDuration)),
                                (this.delayedRerender = this.buildDelayedRerender(e.rerenderDelay)),
                                (this.theme = this.buildTheme(e));
                            var n = this.parseRawLocales(e.locales);
                            this.availableRawLocales = n.map;
                            var i = this.buildLocale(e.locale || n.defaultCode, n.map);
                            (this.dateEnv = this.buildDateEnv(i, e.timeZone, r.namedTimeZonedImpl, e.firstDay, e.weekNumberCalculation, e.weekLabel, r.cmdFormatter)),
                                (this.selectionConfig = this.buildSelectionConfig(e)),
                                (this.viewSpecs = pn(r.views, this.optionsManager)),
                                (this.dateProfileGenerators = Ce(this.viewSpecs, function (e) {
                                    return new e.class.prototype.dateProfileGeneratorClass(e, t);
                                }));
                        }),
                        (e.prototype.getAvailableLocaleCodes = function () {
                            return Object.keys(this.availableRawLocales);
                        }),
                        (e.prototype._buildSelectionConfig = function (e) {
                            return Ot("select", e, this);
                        }),
                        (e.prototype._buildEventUiSingleBase = function (e) {
                            return e.editable && (e = be({}, e, { eventEditable: !0 })), Ot("event", e, this);
                        }),
                        (e.prototype.hasPublicHandlers = function (e) {
                            return this.hasHandlers(e) || this.opt(e);
                        }),
                        (e.prototype.publiclyTrigger = function (e, t) {
                            var r = this.opt(e);
                            if ((this.triggerWith(e, this, t), r)) return r.apply(this, t);
                        }),
                        (e.prototype.publiclyTriggerAfterSizing = function (e, t) {
                            var r = this.afterSizingTriggers;
                            (r[e] || (r[e] = [])).push(t);
                        }),
                        (e.prototype.releaseAfterSizingTriggers = function () {
                            var e = this.afterSizingTriggers;
                            for (var t in e)
                                for (var r = 0, n = e[t]; r < n.length; r++) {
                                    var i = n[r];
                                    this.publiclyTrigger(t, i);
                                }
                            this.afterSizingTriggers = {};
                        }),
                        (e.prototype.isValidViewType = function (e) {
                            return Boolean(this.viewSpecs[e]);
                        }),
                        (e.prototype.changeView = function (e, t) {
                            var r = null;
                            t && (t.start && t.end ? (this.optionsManager.addDynamic({ visibleRange: t }), this.handleOptions(this.optionsManager.computed)) : (r = this.dateEnv.createMarker(t))),
                                this.unselect(),
                                this.dispatch({ type: "SET_VIEW_TYPE", viewType: e, dateMarker: r });
                        }),
                        (e.prototype.zoomTo = function (e, t) {
                            var r;
                            (t = t || "day"),
                                (r = this.viewSpecs[t] || this.getUnitViewSpec(t)),
                                this.unselect(),
                                r ? this.dispatch({ type: "SET_VIEW_TYPE", viewType: r.type, dateMarker: e }) : this.dispatch({ type: "SET_DATE", dateMarker: e });
                        }),
                        (e.prototype.getUnitViewSpec = function (e) {
                            var t, r, n;
                            for (var i in ((t = this.component.header.viewsWithButtons), this.viewSpecs)) t.push(i);
                            for (r = 0; r < t.length; r++) if ((n = this.viewSpecs[t[r]]) && n.singleUnit === e) return n;
                        }),
                        (e.prototype.getInitialDate = function () {
                            var e = this.opt("defaultDate");
                            return null != e ? this.dateEnv.createMarker(e) : this.getNow();
                        }),
                        (e.prototype.prev = function () {
                            this.unselect(), this.dispatch({ type: "PREV" });
                        }),
                        (e.prototype.next = function () {
                            this.unselect(), this.dispatch({ type: "NEXT" });
                        }),
                        (e.prototype.prevYear = function () {
                            this.unselect(), this.dispatch({ type: "SET_DATE", dateMarker: this.dateEnv.addYears(this.state.currentDate, -1) });
                        }),
                        (e.prototype.nextYear = function () {
                            this.unselect(), this.dispatch({ type: "SET_DATE", dateMarker: this.dateEnv.addYears(this.state.currentDate, 1) });
                        }),
                        (e.prototype.today = function () {
                            this.unselect(), this.dispatch({ type: "SET_DATE", dateMarker: this.getNow() });
                        }),
                        (e.prototype.gotoDate = function (e) {
                            this.unselect(), this.dispatch({ type: "SET_DATE", dateMarker: this.dateEnv.createMarker(e) });
                        }),
                        (e.prototype.incrementDate = function (e) {
                            var t = X(e);
                            t && (this.unselect(), this.dispatch({ type: "SET_DATE", dateMarker: this.dateEnv.add(this.state.currentDate, t) }));
                        }),
                        (e.prototype.getDate = function () {
                            return this.dateEnv.toDate(this.state.currentDate);
                        }),
                        (e.prototype.formatDate = function (e, t) {
                            var r = this.dateEnv;
                            return r.format(r.createMarker(e), nt(t));
                        }),
                        (e.prototype.formatRange = function (e, t, r) {
                            var n = this.dateEnv;
                            return n.formatRange(n.createMarker(e), n.createMarker(t), nt(r, this.opt("defaultRangeSeparator")), r);
                        }),
                        (e.prototype.formatIso = function (e, t) {
                            var r = this.dateEnv;
                            return r.formatIso(r.createMarker(e), { omitTime: t });
                        }),
                        (e.prototype.windowResize = function (e) {
                            !this.isHandlingWindowResize &&
                                this.component &&
                                e.target === window &&
                                ((this.isHandlingWindowResize = !0), this.updateSize(), this.publiclyTrigger("windowResize", [this.view]), (this.isHandlingWindowResize = !1));
                        }),
                        (e.prototype.updateSize = function () {
                            this.component && this.component.updateSize(!0);
                        }),
                        (e.prototype.registerInteractiveComponent = function (e, t) {
                            var r = (function (e, t) {
                                    return { component: e, el: t.el, useEventCenter: null == t.useEventCenter || t.useEventCenter };
                                })(e, t),
                                n = [En, bn],
                                i = n.concat(this.pluginSystem.hooks.componentInteractions),
                                o = i.map(function (e) {
                                    return new e(r);
                                });
                            (this.interactionsStore[e.uid] = o), (Sn[e.uid] = r);
                        }),
                        (e.prototype.unregisterInteractiveComponent = function (e) {
                            for (var t = 0, r = this.interactionsStore[e.uid]; t < r.length; t++) {
                                var n = r[t];
                                n.destroy();
                            }
                            delete this.interactionsStore[e.uid], delete Sn[e.uid];
                        }),
                        (e.prototype.select = function (e, t) {
                            var r = an(null == t ? (null != e.start ? e : { start: e, end: null }) : { start: e, end: t }, this.dateEnv, X({ days: 1 }));
                            r && (this.dispatch({ type: "SELECT_DATES", selection: r }), this.triggerDateSelect(r));
                        }),
                        (e.prototype.unselect = function (e) {
                            this.state.dateSelection && (this.dispatch({ type: "UNSELECT_DATES" }), this.triggerDateUnselect(e));
                        }),
                        (e.prototype.triggerDateSelect = function (e, t) {
                            var r = this.buildDateSpanApi(e);
                            (r.jsEvent = t ? t.origEvent : null), (r.view = this.view), this.publiclyTrigger("select", [r]);
                        }),
                        (e.prototype.triggerDateUnselect = function (e) {
                            this.publiclyTrigger("unselect", [{ jsEvent: e ? e.origEvent : null, view: this.view }]);
                        }),
                        (e.prototype.triggerDateClick = function (e, t, r, n) {
                            var i = this.buildDatePointApi(e);
                            (i.dayEl = t), (i.jsEvent = n), (i.view = r), this.publiclyTrigger("dateClick", [i]);
                        }),
                        (e.prototype.buildDatePointApi = function (e) {
                            for (var t, r, n = {}, i = 0, o = this.pluginSystem.hooks.datePointTransforms; i < o.length; i++) {
                                var s = o[i];
                                be(n, s(e, this));
                            }
                            return be(n, ((t = e), { date: (r = this.dateEnv).toDate(t.range.start), dateStr: r.formatIso(t.range.start, { omitTime: t.allDay }), allDay: t.allDay })), n;
                        }),
                        (e.prototype.buildDateSpanApi = function (e) {
                            for (var t, r, n = {}, i = 0, o = this.pluginSystem.hooks.dateSpanTransforms; i < o.length; i++) {
                                var s = o[i];
                                be(n, s(e, this));
                            }
                            return (
                                be(
                                    n,
                                    ((t = e),
                                    {
                                        start: (r = this.dateEnv).toDate(t.range.start),
                                        end: r.toDate(t.range.end),
                                        startStr: r.formatIso(t.range.start, { omitTime: t.allDay }),
                                        endStr: r.formatIso(t.range.end, { omitTime: t.allDay }),
                                        allDay: t.allDay,
                                    })
                                ),
                                n
                            );
                        }),
                        (e.prototype.getNow = function () {
                            var e = this.opt("now");
                            return "function" == typeof e && (e = e()), null == e ? this.dateEnv.createNowMarker() : this.dateEnv.createMarker(e);
                        }),
                        (e.prototype.getDefaultEventEnd = function (e, t) {
                            var r = t;
                            return e ? ((r = A(r)), (r = this.dateEnv.add(r, this.defaultAllDayEventDuration))) : (r = this.dateEnv.add(r, this.defaultTimedEventDuration)), r;
                        }),
                        (e.prototype.addEvent = function (e, t) {
                            if (e instanceof lt) {
                                var r = e._def,
                                    n = e._instance;
                                return this.state.eventStore.defs[r.defId] || this.dispatch({ type: "ADD_EVENTS", eventStore: Pe({ def: r, instance: n }) }), e;
                            }
                            var i;
                            if (t instanceof at) i = t.internalEventSource.sourceId;
                            else if (null != t) {
                                var o = this.getEventSourceById(t);
                                if (!o) return console.warn('Could not find an event source with ID "' + t + '"'), null;
                                i = o.internalEventSource.sourceId;
                            }
                            var s = Ut(e, i, this);
                            return s ? (this.dispatch({ type: "ADD_EVENTS", eventStore: Pe(s) }), new lt(this, s.def, s.def.recurringDef ? null : s.instance)) : null;
                        }),
                        (e.prototype.getEventById = function (e) {
                            var t = this.state.eventStore,
                                r = t.defs,
                                n = t.instances;
                            for (var i in ((e = String(e)), r)) {
                                var o = r[i];
                                if (o.publicId === e) {
                                    if (o.recurringDef) return new lt(this, o, null);
                                    for (var s in n) {
                                        var a = n[s];
                                        if (a.defId === o.defId) return new lt(this, o, a);
                                    }
                                }
                            }
                            return null;
                        }),
                        (e.prototype.getEvents = function () {
                            var e = this.state.eventStore,
                                t = e.defs,
                                r = e.instances,
                                n = [];
                            for (var i in r) {
                                var o = r[i],
                                    s = t[o.defId];
                                n.push(new lt(this, s, o));
                            }
                            return n;
                        }),
                        (e.prototype.removeAllEvents = function () {
                            this.dispatch({ type: "REMOVE_ALL_EVENTS" });
                        }),
                        (e.prototype.rerenderEvents = function () {
                            this.dispatch({ type: "RESET_EVENTS" });
                        }),
                        (e.prototype.getEventSources = function () {
                            var e = this.state.eventSources,
                                t = [];
                            for (var r in e) t.push(new at(this, e[r]));
                            return t;
                        }),
                        (e.prototype.getEventSourceById = function (e) {
                            var t = this.state.eventSources;
                            for (var r in ((e = String(e)), t)) if (t[r].publicId === e) return new at(this, t[r]);
                            return null;
                        }),
                        (e.prototype.addEventSource = function (e) {
                            if (e instanceof at) return this.state.eventSources[e.internalEventSource.sourceId] || this.dispatch({ type: "ADD_EVENT_SOURCES", sources: [e.internalEventSource] }), e;
                            var t = Gr(e, this);
                            return t ? (this.dispatch({ type: "ADD_EVENT_SOURCES", sources: [t] }), new at(this, t)) : null;
                        }),
                        (e.prototype.removeAllEventSources = function () {
                            this.dispatch({ type: "REMOVE_ALL_EVENT_SOURCES" });
                        }),
                        (e.prototype.refetchEvents = function () {
                            this.dispatch({ type: "FETCH_EVENT_SOURCES" });
                        }),
                        e
                    );
                })();
                function Tn(e, t, r, n, i, o, s) {
                    return new Vr({ calendarSystem: "gregory", timeZone: t, namedTimeZoneImpl: r, locale: e, weekNumberCalculation: i, firstDay: n, weekLabel: o, cmdFormatter: s });
                }
                function Cn(e) {
                    var t = this.pluginSystem.hooks.themeClasses[e.themeSystem] || Dn;
                    return new t(e);
                }
                function Rn(e) {
                    var t = this.tryRerender.bind(this);
                    return null != e && (t = pe(t, e)), t;
                }
                function In(e) {
                    return Ce(e, function (e) {
                        return e.ui;
                    });
                }
                function Mn(e, t, r) {
                    var n = { "": t };
                    for (var i in e) {
                        var o = e[i];
                        o.sourceId && r[o.sourceId] && (n[i] = r[o.sourceId]);
                    }
                    return n;
                }
                rr.mixInto(wn);
                var Pn = (function (e) {
                    function t(t, r, i, o) {
                        var s = e.call(this, t, n("div", { className: "fc-view fc-" + r.type + "-view" }), !0) || this;
                        return (
                            (s.renderDatesMem = Yt(s.renderDatesWrap, s.unrenderDatesWrap)),
                            (s.renderBusinessHoursMem = Yt(s.renderBusinessHours, s.unrenderBusinessHours, [s.renderDatesMem])),
                            (s.renderDateSelectionMem = Yt(s.renderDateSelectionWrap, s.unrenderDateSelectionWrap, [s.renderDatesMem])),
                            (s.renderEventsMem = Yt(s.renderEvents, s.unrenderEvents, [s.renderDatesMem])),
                            (s.renderEventSelectionMem = Yt(s.renderEventSelectionWrap, s.unrenderEventSelectionWrap, [s.renderEventsMem])),
                            (s.renderEventDragMem = Yt(s.renderEventDragWrap, s.unrenderEventDragWrap, [s.renderDatesMem])),
                            (s.renderEventResizeMem = Yt(s.renderEventResizeWrap, s.unrenderEventResizeWrap, [s.renderDatesMem])),
                            (s.viewSpec = r),
                            (s.dateProfileGenerator = i),
                            (s.type = r.type),
                            (s.eventOrderSpecs = ie(s.opt("eventOrder"))),
                            (s.nextDayThreshold = X(s.opt("nextDayThreshold"))),
                            o.appendChild(s.el),
                            s.initialize(),
                            s
                        );
                    }
                    return (
                        Ee(t, e),
                        (t.prototype.initialize = function () {}),
                        Object.defineProperty(t.prototype, "activeStart", {
                            get: function () {
                                return this.dateEnv.toDate(this.props.dateProfile.activeRange.start);
                            },
                            enumerable: !0,
                            configurable: !0,
                        }),
                        Object.defineProperty(t.prototype, "activeEnd", {
                            get: function () {
                                return this.dateEnv.toDate(this.props.dateProfile.activeRange.end);
                            },
                            enumerable: !0,
                            configurable: !0,
                        }),
                        Object.defineProperty(t.prototype, "currentStart", {
                            get: function () {
                                return this.dateEnv.toDate(this.props.dateProfile.currentRange.start);
                            },
                            enumerable: !0,
                            configurable: !0,
                        }),
                        Object.defineProperty(t.prototype, "currentEnd", {
                            get: function () {
                                return this.dateEnv.toDate(this.props.dateProfile.currentRange.end);
                            },
                            enumerable: !0,
                            configurable: !0,
                        }),
                        (t.prototype.render = function (e) {
                            this.renderDatesMem(e.dateProfile),
                                this.renderBusinessHoursMem(e.businessHours),
                                this.renderDateSelectionMem(e.dateSelection),
                                this.renderEventsMem(e.eventStore),
                                this.renderEventSelectionMem(e.eventSelection),
                                this.renderEventDragMem(e.eventDrag),
                                this.renderEventResizeMem(e.eventResize);
                        }),
                        (t.prototype.destroy = function () {
                            e.prototype.destroy.call(this), this.renderDatesMem.unrender();
                        }),
                        (t.prototype.updateSize = function (e, t, r) {
                            var n = this.calendar;
                            (e || n.isViewUpdated || n.isDatesUpdated || n.isEventsUpdated) && this.updateBaseSize(e, t, r);
                        }),
                        (t.prototype.updateBaseSize = function (e, t, r) {}),
                        (t.prototype.renderDatesWrap = function (e) {
                            this.renderDates(e), this.addScroll({ isDateInit: !0 }), this.startNowIndicator(e);
                        }),
                        (t.prototype.unrenderDatesWrap = function () {
                            this.stopNowIndicator(), this.unrenderDates();
                        }),
                        (t.prototype.renderDates = function (e) {}),
                        (t.prototype.unrenderDates = function () {}),
                        (t.prototype.renderBusinessHours = function (e) {}),
                        (t.prototype.unrenderBusinessHours = function () {}),
                        (t.prototype.renderDateSelectionWrap = function (e) {
                            e && this.renderDateSelection(e);
                        }),
                        (t.prototype.unrenderDateSelectionWrap = function (e) {
                            e && this.unrenderDateSelection(e);
                        }),
                        (t.prototype.renderDateSelection = function (e) {}),
                        (t.prototype.unrenderDateSelection = function (e) {}),
                        (t.prototype.renderEvents = function (e) {}),
                        (t.prototype.unrenderEvents = function () {}),
                        (t.prototype.sliceEvents = function (e, t) {
                            var r = this.props;
                            return ct(e, r.eventUiBases, r.dateProfile.activeRange, t ? this.nextDayThreshold : null).fg;
                        }),
                        (t.prototype.renderEventSelectionWrap = function (e) {
                            e && this.renderEventSelection(e);
                        }),
                        (t.prototype.unrenderEventSelectionWrap = function (e) {
                            e && this.unrenderEventSelection(e);
                        }),
                        (t.prototype.renderEventSelection = function (e) {}),
                        (t.prototype.unrenderEventSelection = function (e) {}),
                        (t.prototype.renderEventDragWrap = function (e) {
                            e && this.renderEventDrag(e);
                        }),
                        (t.prototype.unrenderEventDragWrap = function (e) {
                            e && this.unrenderEventDrag(e);
                        }),
                        (t.prototype.renderEventDrag = function (e) {}),
                        (t.prototype.unrenderEventDrag = function (e) {}),
                        (t.prototype.renderEventResizeWrap = function (e) {
                            e && this.renderEventResize(e);
                        }),
                        (t.prototype.unrenderEventResizeWrap = function (e) {
                            e && this.unrenderEventResize(e);
                        }),
                        (t.prototype.renderEventResize = function (e) {}),
                        (t.prototype.unrenderEventResize = function (e) {}),
                        (t.prototype.startNowIndicator = function (e) {
                            var t,
                                r,
                                n,
                                i = this,
                                o = this.dateEnv;
                            this.opt("nowIndicator") &&
                                (t = this.getNowIndicatorUnit(e)) &&
                                ((r = this.updateNowIndicator.bind(this)),
                                (this.initialNowDate = this.calendar.getNow()),
                                (this.initialNowQueriedMs = new Date().valueOf()),
                                (n = o.add(o.startOf(this.initialNowDate, t), X(1, t)).valueOf() - this.initialNowDate.valueOf()),
                                (this.nowIndicatorTimeoutID = setTimeout(function () {
                                    (i.nowIndicatorTimeoutID = null), r(), (n = "second" === t ? 1e3 : 6e4), (i.nowIndicatorIntervalID = setInterval(r, n));
                                }, n)));
                        }),
                        (t.prototype.updateNowIndicator = function () {
                            this.props.dateProfile &&
                                this.initialNowDate &&
                                (this.unrenderNowIndicator(), this.renderNowIndicator(x(this.initialNowDate, new Date().valueOf() - this.initialNowQueriedMs)), (this.isNowIndicatorRendered = !0));
                        }),
                        (t.prototype.stopNowIndicator = function () {
                            this.isNowIndicatorRendered &&
                                (this.nowIndicatorTimeoutID && (clearTimeout(this.nowIndicatorTimeoutID), (this.nowIndicatorTimeoutID = null)),
                                this.nowIndicatorIntervalID && (clearInterval(this.nowIndicatorIntervalID), (this.nowIndicatorIntervalID = null)),
                                this.unrenderNowIndicator(),
                                (this.isNowIndicatorRendered = !1));
                        }),
                        (t.prototype.getNowIndicatorUnit = function (e) {}),
                        (t.prototype.renderNowIndicator = function (e) {}),
                        (t.prototype.unrenderNowIndicator = function () {}),
                        (t.prototype.addScroll = function (e) {
                            var t = this.queuedScroll || (this.queuedScroll = {});
                            be(t, e);
                        }),
                        (t.prototype.popScroll = function (e) {
                            this.applyQueuedScroll(e), (this.queuedScroll = null);
                        }),
                        (t.prototype.applyQueuedScroll = function (e) {
                            this.applyScroll(this.queuedScroll || {}, e);
                        }),
                        (t.prototype.queryScroll = function () {
                            var e = {};
                            return this.props.dateProfile && be(e, this.queryDateScroll()), e;
                        }),
                        (t.prototype.applyScroll = function (e, t) {
                            e.isDateInit && (delete e.isDateInit, this.props.dateProfile && be(e, this.computeInitialDateScroll())), this.props.dateProfile && this.applyDateScroll(e);
                        }),
                        (t.prototype.computeInitialDateScroll = function () {
                            return {};
                        }),
                        (t.prototype.queryDateScroll = function () {
                            return {};
                        }),
                        (t.prototype.applyDateScroll = function (e) {}),
                        t
                    );
                })(pr);
                rr.mixInto(Pn), (Pn.prototype.usesMinMaxTime = !1), (Pn.prototype.dateProfileGeneratorClass = Kr);
                var Hn = (function () {
                    function e(e) {
                        (this.segs = []), (this.isSizeDirty = !1), (this.context = e);
                    }
                    return (
                        (e.prototype.renderSegs = function (e, t) {
                            this.rangeUpdated(), (e = this.renderSegEls(e, t)), (this.segs = e), this.attachSegs(e, t), (this.isSizeDirty = !0), this.context.view.triggerRenderedSegs(this.segs, Boolean(t));
                        }),
                        (e.prototype.unrender = function (e, t) {
                            this.context.view.triggerWillRemoveSegs(this.segs, Boolean(t)), this.detachSegs(this.segs), (this.segs = []);
                        }),
                        (e.prototype.rangeUpdated = function () {
                            var e,
                                t,
                                r = this.context.options;
                            (this.eventTimeFormat = nt(r.eventTimeFormat || this.computeEventTimeFormat(), r.defaultRangeSeparator)),
                                null == (e = r.displayEventTime) && (e = this.computeDisplayEventTime()),
                                null == (t = r.displayEventEnd) && (t = this.computeDisplayEventEnd()),
                                (this.displayEventTime = e),
                                (this.displayEventEnd = t);
                        }),
                        (e.prototype.renderSegEls = function (e, t) {
                            var r,
                                n = "";
                            if (e.length) {
                                for (r = 0; r < e.length; r++) n += this.renderSegHtml(e[r], t);
                                o(n).forEach(function (t, r) {
                                    var n = e[r];
                                    t && (n.el = t);
                                }),
                                    (e = ut(this.context.view, e, Boolean(t)));
                            }
                            return e;
                        }),
                        (e.prototype.getSegClasses = function (e, t, r, n) {
                            var i = ["fc-event", e.isStart ? "fc-start" : "fc-not-start", e.isEnd ? "fc-end" : "fc-not-end"].concat(e.eventRange.ui.classNames);
                            return t && i.push("fc-draggable"), r && i.push("fc-resizable"), n && (i.push("fc-mirror"), n.isDragging && i.push("fc-dragging"), n.isResizing && i.push("fc-resizing")), i;
                        }),
                        (e.prototype.getTimeText = function (e, t, r) {
                            var n = e.def,
                                i = e.instance;
                            return this._getTimeText(i.range.start, n.hasEnd ? i.range.end : null, n.allDay, t, r, i.forcedStartTzo, i.forcedEndTzo);
                        }),
                        (e.prototype._getTimeText = function (e, t, r, n, i, o, s) {
                            var a = this.context.dateEnv;
                            return (
                                null == n && (n = this.eventTimeFormat),
                                null == i && (i = this.displayEventEnd),
                                this.displayEventTime && !r ? (i && t ? a.formatRange(e, t, n, { forcedStartTzo: o, forcedEndTzo: s }) : a.format(e, n, { forcedTzo: o })) : ""
                            );
                        }),
                        (e.prototype.computeEventTimeFormat = function () {
                            return { hour: "numeric", minute: "2-digit", omitZeroMinute: !0 };
                        }),
                        (e.prototype.computeDisplayEventTime = function () {
                            return !0;
                        }),
                        (e.prototype.computeDisplayEventEnd = function () {
                            return !0;
                        }),
                        (e.prototype.getSkinCss = function (e) {
                            return { "background-color": e.backgroundColor, "border-color": e.borderColor, color: e.textColor };
                        }),
                        (e.prototype.sortEventSegs = function (e) {
                            var t = this.context.view.eventOrderSpecs,
                                r = e.map(kn);
                            return (
                                r.sort(function (e, r) {
                                    return oe(e, r, t);
                                }),
                                r.map(function (e) {
                                    return e._seg;
                                })
                            );
                        }),
                        (e.prototype.computeSizes = function (e) {
                            (e || this.isSizeDirty) && this.computeSegSizes(this.segs);
                        }),
                        (e.prototype.assignSizes = function (e) {
                            (e || this.isSizeDirty) && (this.assignSegSizes(this.segs), (this.isSizeDirty = !1));
                        }),
                        (e.prototype.computeSegSizes = function (e) {}),
                        (e.prototype.assignSegSizes = function (e) {}),
                        (e.prototype.hideByHash = function (e) {
                            if (e)
                                for (var t = 0, r = this.segs; t < r.length; t++) {
                                    var n = r[t];
                                    e[n.eventRange.instance.instanceId] && (n.el.style.visibility = "hidden");
                                }
                        }),
                        (e.prototype.showByHash = function (e) {
                            if (e)
                                for (var t = 0, r = this.segs; t < r.length; t++) {
                                    var n = r[t];
                                    e[n.eventRange.instance.instanceId] && (n.el.style.visibility = "");
                                }
                        }),
                        (e.prototype.selectByInstanceId = function (e) {
                            if (e)
                                for (var t = 0, r = this.segs; t < r.length; t++) {
                                    var n = r[t],
                                        i = n.eventRange.instance;
                                    i && i.instanceId === e && n.el && n.el.classList.add("fc-selected");
                                }
                        }),
                        (e.prototype.unselectByInstanceId = function (e) {
                            if (e)
                                for (var t = 0, r = this.segs; t < r.length; t++) {
                                    var n = r[t];
                                    n.el && n.el.classList.remove("fc-selected");
                                }
                        }),
                        e
                    );
                })();
                function kn(e) {
                    var t = e.eventRange.def,
                        r = e.eventRange.instance.range,
                        n = r.start ? r.start.valueOf() : 0,
                        i = r.end ? r.end.valueOf() : 0;
                    return be({}, t.extendedProps, t, { id: t.publicId, start: n, end: i, duration: i - n, allDay: Number(t.allDay), _seg: e });
                }
                var _n = (function () {
                        function e(e) {
                            (this.fillSegTag = "div"), (this.dirtySizeFlags = {}), (this.context = e), (this.containerElsByType = {}), (this.segsByType = {});
                        }
                        return (
                            (e.prototype.getSegsByType = function (e) {
                                return this.segsByType[e] || [];
                            }),
                            (e.prototype.renderSegs = function (e, t) {
                                var r,
                                    n = this.renderSegEls(e, t),
                                    i = this.attachSegs(e, n);
                                i && (r = this.containerElsByType[e] || (this.containerElsByType[e] = [])).push.apply(r, i),
                                    (this.segsByType[e] = n),
                                    "bgEvent" === e && this.context.view.triggerRenderedSegs(n, !1),
                                    (this.dirtySizeFlags[e] = !0);
                            }),
                            (e.prototype.unrender = function (e) {
                                var t = this.segsByType[e];
                                t && ("bgEvent" === e && this.context.view.triggerWillRemoveSegs(t, !1), this.detachSegs(e, t));
                            }),
                            (e.prototype.renderSegEls = function (e, t) {
                                var r,
                                    n = this,
                                    i = "";
                                if (t.length) {
                                    for (r = 0; r < t.length; r++) i += this.renderSegHtml(e, t[r]);
                                    o(i).forEach(function (e, r) {
                                        var n = t[r];
                                        e && (n.el = e);
                                    }),
                                        "bgEvent" === e && (t = ut(this.context.view, t, !1)),
                                        (t = t.filter(function (e) {
                                            return f(e.el, n.fillSegTag);
                                        }));
                                }
                                return t;
                            }),
                            (e.prototype.renderSegHtml = function (e, t) {
                                var r = null,
                                    n = [];
                                return (
                                    "highlight" !== e && "businessHours" !== e && (r = { "background-color": t.eventRange.ui.backgroundColor }),
                                    "highlight" !== e && (n = n.concat(t.eventRange.ui.classNames)),
                                    "businessHours" === e ? n.push("fc-bgevent") : n.push("fc-" + e.toLowerCase()),
                                    "<" + this.fillSegTag + (n.length ? ' class="' + n.join(" ") + '"' : "") + (r ? ' style="' + Ht(r) + '"' : "") + "></" + this.fillSegTag + ">"
                                );
                            }),
                            (e.prototype.detachSegs = function (e, t) {
                                var r = this.containerElsByType[e];
                                r && (r.forEach(u), delete this.containerElsByType[e]);
                            }),
                            (e.prototype.computeSizes = function (e) {
                                for (var t in this.segsByType) (e || this.dirtySizeFlags[t]) && this.computeSegSizes(this.segsByType[t]);
                            }),
                            (e.prototype.assignSizes = function (e) {
                                for (var t in this.segsByType) (e || this.dirtySizeFlags[t]) && this.assignSegSizes(this.segsByType[t]);
                                this.dirtySizeFlags = {};
                            }),
                            (e.prototype.computeSegSizes = function (e) {}),
                            (e.prototype.assignSegSizes = function (e) {}),
                            e
                        );
                    })(),
                    xn = function (e) {
                        this.timeZoneName = e;
                    },
                    On = (function () {
                        function e(e) {
                            this.emitter = new rr();
                        }
                        return (e.prototype.destroy = function () {}), (e.prototype.setMirrorIsVisible = function (e) {}), (e.prototype.setMirrorNeedsRevert = function (e) {}), (e.prototype.setAutoScrollEnabled = function (e) {}), e;
                    })();
                function zn(e) {
                    var t = kr(e.locale || "en", Hr([]).map);
                    return (e = be({ timeZone: Cr.timeZone, calendarSystem: "gregory" }, e, { locale: t })), new Vr(e);
                }
                var Ln = { startTime: X, duration: X, create: Boolean, sourceId: String },
                    Nn = { create: !0 };
                function An(e, t) {
                    return !e || t > 10 ? { weekday: "short" } : t > 1 ? { weekday: "short", month: "numeric", day: "numeric", omitCommas: !0 } : { weekday: "long" };
                }
                function Bn(e, t, r, n, i, o, s, a) {
                    var l,
                        c = o.view,
                        u = o.dateEnv,
                        d = o.theme,
                        h = o.options,
                        p = We(t.activeRange, e),
                        f = ["fc-day-header", d.getClass("widgetHeader")];
                    return (
                        (l = "function" == typeof h.columnHeaderHtml ? h.columnHeaderHtml(u.toDate(e)) : "function" == typeof h.columnHeaderText ? Pt(h.columnHeaderText(u.toDate(e))) : Pt(u.format(e, i))),
                        r ? (f = f.concat($t(e, t, o, !0))) : f.push("fc-" + k[e.getUTCDay()]),
                        '<th class="' +
                            f.join(" ") +
                            '"' +
                            (p && r ? ' data-date="' + u.formatIso(e, { omitTime: !0 }) + '"' : "") +
                            (s > 1 ? ' colspan="' + s + '"' : "") +
                            (a ? " " + a : "") +
                            ">" +
                            (p ? Qt(c, { date: e, forceOff: !r || 1 === n }, l) : l) +
                            "</th>"
                    );
                }
                var Vn = (function (e) {
                        function t(t, r) {
                            var n = e.call(this, t) || this;
                            return (
                                (r.innerHTML = ""),
                                r.appendChild((n.el = i('<div class="fc-row ' + n.theme.getClass("headerRow") + '"><table class="' + n.theme.getClass("tableGrid") + '"><thead></thead></table></div>'))),
                                (n.thead = n.el.querySelector("thead")),
                                n
                            );
                        }
                        return (
                            Ee(t, e),
                            (t.prototype.destroy = function () {
                                u(this.el);
                            }),
                            (t.prototype.render = function (e) {
                                var t = e.dates,
                                    r = e.datesRepDistinctDays,
                                    n = [];
                                e.renderIntroHtml && n.push(e.renderIntroHtml());
                                for (var i = nt(this.opt("columnHeaderFormat") || An(r, t.length)), o = 0, s = t; o < s.length; o++) {
                                    var a = s[o];
                                    n.push(Bn(a, e.dateProfile, r, t.length, i, this.context));
                                }
                                this.isRtl && n.reverse(), (this.thead.innerHTML = "<tr>" + n.join("") + "</tr>");
                            }),
                            t
                        );
                    })(hr),
                    Un = (function () {
                        function e(e, t) {
                            for (var r = e.start, n = e.end, i = [], o = [], s = -1; r < n; ) t.isHiddenDay(r) ? i.push(s + 0.5) : (s++, i.push(s), o.push(r)), (r = _(r, 1));
                            (this.dates = o), (this.indices = i), (this.cnt = o.length);
                        }
                        return (
                            (e.prototype.sliceRange = function (e) {
                                var t = this.getDateDayIndex(e.start),
                                    r = this.getDateDayIndex(_(e.end, -1)),
                                    n = Math.max(0, t),
                                    i = Math.min(this.cnt - 1, r);
                                return (n = Math.ceil(n)), (i = Math.floor(i)), n <= i ? { firstIndex: n, lastIndex: i, isStart: t === n, isEnd: r === i } : null;
                            }),
                            (e.prototype.getDateDayIndex = function (e) {
                                var t = this.indices,
                                    r = Math.floor(O(this.dates[0], e));
                                return r < 0 ? t[0] - 1 : r >= t.length ? t[t.length - 1] + 1 : t[r];
                            }),
                            e
                        );
                    })(),
                    Wn = (function () {
                        function e(e, t) {
                            var r,
                                n,
                                i,
                                o = e.dates;
                            if (t) {
                                for (n = o[0].getUTCDay(), r = 1; r < o.length && o[r].getUTCDay() !== n; r++);
                                i = Math.ceil(o.length / r);
                            } else (i = 1), (r = o.length);
                            (this.rowCnt = i), (this.colCnt = r), (this.daySeries = e), (this.cells = this.buildCells()), (this.headerDates = this.buildHeaderDates());
                        }
                        return (
                            (e.prototype.buildCells = function () {
                                for (var e = [], t = 0; t < this.rowCnt; t++) {
                                    for (var r = [], n = 0; n < this.colCnt; n++) r.push(this.buildCell(t, n));
                                    e.push(r);
                                }
                                return e;
                            }),
                            (e.prototype.buildCell = function (e, t) {
                                return { date: this.daySeries.dates[e * this.colCnt + t] };
                            }),
                            (e.prototype.buildHeaderDates = function () {
                                for (var e = [], t = 0; t < this.colCnt; t++) e.push(this.cells[0][t].date);
                                return e;
                            }),
                            (e.prototype.sliceRange = function (e) {
                                var t = this.colCnt,
                                    r = this.daySeries.sliceRange(e),
                                    n = [];
                                if (r)
                                    for (var i = r.firstIndex, o = r.lastIndex, s = i; s <= o; ) {
                                        var a = Math.floor(s / t),
                                            l = Math.min((a + 1) * t, o + 1);
                                        n.push({ row: a, firstCol: s % t, lastCol: (l - 1) % t, isStart: r.isStart && s === i, isEnd: r.isEnd && l - 1 === o }), (s = l);
                                    }
                                return n;
                            }),
                            e
                        );
                    })(),
                    Fn = (function () {
                        function e() {
                            (this.sliceBusinessHours = Ge(this._sliceBusinessHours)),
                                (this.sliceDateSelection = Ge(this._sliceDateSpan)),
                                (this.sliceEventStore = Ge(this._sliceEventStore)),
                                (this.sliceEventDrag = Ge(this._sliceInteraction)),
                                (this.sliceEventResize = Ge(this._sliceInteraction));
                        }
                        return (
                            (e.prototype.sliceProps = function (e, t, r, n) {
                                for (var i = [], o = 4; o < arguments.length; o++) i[o - 4] = arguments[o];
                                var s = e.eventUiBases,
                                    a = this.sliceEventStore.apply(this, [e.eventStore, s, t, r, n].concat(i));
                                return {
                                    dateSelectionSegs: this.sliceDateSelection.apply(this, [e.dateSelection, s, n].concat(i)),
                                    businessHourSegs: this.sliceBusinessHours.apply(this, [e.businessHours, t, r, n].concat(i)),
                                    fgEventSegs: a.fg,
                                    bgEventSegs: a.bg,
                                    eventDrag: this.sliceEventDrag.apply(this, [e.eventDrag, s, t, r, n].concat(i)),
                                    eventResize: this.sliceEventResize.apply(this, [e.eventResize, s, t, r, n].concat(i)),
                                    eventSelection: e.eventSelection,
                                };
                            }),
                            (e.prototype.sliceNowDate = function (e, t) {
                                for (var r = [], n = 2; n < arguments.length; n++) r[n - 2] = arguments[n];
                                return this._sliceDateSpan.apply(this, [{ range: { start: e, end: x(e, 1) }, allDay: !1 }, {}, t].concat(r));
                            }),
                            (e.prototype._sliceBusinessHours = function (e, t, r, n) {
                                for (var i = [], o = 4; o < arguments.length; o++) i[o - 4] = arguments[o];
                                return e ? this._sliceEventStore.apply(this, [He(e, Gn(t, Boolean(r)), n.calendar), {}, t, r, n].concat(i)).bg : [];
                            }),
                            (e.prototype._sliceEventStore = function (e, t, r, n, i) {
                                for (var o = [], s = 5; s < arguments.length; s++) o[s - 5] = arguments[s];
                                if (e) {
                                    var a = ct(e, t, Gn(r, Boolean(n)), n);
                                    return { bg: this.sliceEventRanges(a.bg, i, o), fg: this.sliceEventRanges(a.fg, i, o) };
                                }
                                return { bg: [], fg: [] };
                            }),
                            (e.prototype._sliceInteraction = function (e, t, r, n, i) {
                                for (var o = [], s = 5; s < arguments.length; s++) o[s - 5] = arguments[s];
                                if (!e) return null;
                                var a = ct(e.mutatedEvents, t, Gn(r, Boolean(n)), n);
                                return { segs: this.sliceEventRanges(a.fg, i, o), affectedInstances: e.affectedEvents.instances, isEvent: e.isEvent, sourceSeg: e.origSeg };
                            }),
                            (e.prototype._sliceDateSpan = function (e, t, r) {
                                for (var n = [], i = 3; i < arguments.length; i++) n[i - 3] = arguments[i];
                                if (!e) return [];
                                for (
                                    var o = (function (e, t, r) {
                                            var n = Wt({ editable: !1 }, "", e.allDay, !0, r);
                                            return { def: n, ui: ft(n, t), instance: Ft(n.defId, e.range), range: e.range, isStart: !0, isEnd: !0 };
                                        })(e, t, r.calendar),
                                        s = this.sliceRange.apply(this, [e.range].concat(n)),
                                        a = 0,
                                        l = s;
                                    a < l.length;
                                    a++
                                ) {
                                    var c = l[a];
                                    (c.component = r), (c.eventRange = o);
                                }
                                return s;
                            }),
                            (e.prototype.sliceEventRanges = function (e, t, r) {
                                for (var n = [], i = 0, o = e; i < o.length; i++) {
                                    var s = o[i];
                                    n.push.apply(n, this.sliceEventRange(s, t, r));
                                }
                                return n;
                            }),
                            (e.prototype.sliceEventRange = function (e, t, r) {
                                for (var n = this.sliceRange.apply(this, [e.range].concat(r)), i = 0, o = n; i < o.length; i++) {
                                    var s = o[i];
                                    (s.component = t), (s.eventRange = e), (s.isStart = e.isStart && s.isStart), (s.isEnd = e.isEnd && s.isEnd);
                                }
                                return n;
                            }),
                            e
                        );
                    })();
                function Gn(e, t) {
                    var r = e.activeRange;
                    return t ? r : { start: x(r.start, e.minTime.milliseconds), end: x(r.end, e.maxTime.milliseconds - 864e5) };
                }
                (e.Calendar = wn),
                    (e.Component = hr),
                    (e.DateComponent = pr),
                    (e.DateEnv = Vr),
                    (e.DateProfileGenerator = Kr),
                    (e.DayHeader = Vn),
                    (e.DaySeries = Un),
                    (e.DayTable = Wn),
                    (e.ElementDragging = On),
                    (e.ElementScrollController = ar),
                    (e.EmitterMixin = rr),
                    (e.EventApi = lt),
                    (e.FgEventRenderer = Hn),
                    (e.FillRenderer = _n),
                    (e.Interaction = yn),
                    (e.Mixin = tr),
                    (e.NamedTimeZoneImpl = xn),
                    (e.PositionCache = or),
                    (e.ScrollComponent = cr),
                    (e.ScrollController = sr),
                    (e.Slicer = Fn),
                    (e.Splitter = Jt),
                    (e.Theme = ur),
                    (e.View = Pn),
                    (e.WindowScrollController = lr),
                    (e.addDays = _),
                    (e.addDurations = function (e, t) {
                        return { years: e.years + t.years, months: e.months + t.months, days: e.days + t.days, milliseconds: e.milliseconds + t.milliseconds };
                    }),
                    (e.addMs = x),
                    (e.addWeeks = function (e, t) {
                        var r = F(e);
                        return (r[2] += 7 * t), G(r);
                    }),
                    (e.allowContextMenu = function (e) {
                        e.removeEventListener("contextmenu", M);
                    }),
                    (e.allowSelection = function (e) {
                        e.classList.remove("fc-unselectable"), e.removeEventListener("selectstart", M);
                    }),
                    (e.appendToElement = a),
                    (e.applyAll = de),
                    (e.applyMutationToEventStore = gt),
                    (e.applyStyle = m),
                    (e.applyStyleProp = y),
                    (e.asRoughMinutes = function (e) {
                        return te(e) / 6e4;
                    }),
                    (e.asRoughMs = te),
                    (e.asRoughSeconds = function (e) {
                        return te(e) / 1e3;
                    }),
                    (e.buildGotoAnchorHtml = Qt),
                    (e.buildSegCompareObj = kn),
                    (e.capitaliseFirstLetter = le),
                    (e.combineEventUis = Lt),
                    (e.compareByFieldSpec = se),
                    (e.compareByFieldSpecs = oe),
                    (e.compareNumbers = function (e, t) {
                        return e - t;
                    }),
                    (e.compensateScroll = function (e, t) {
                        t.left && m(e, { borderLeftWidth: 1, marginLeft: t.left - 1 }), t.right && m(e, { borderRightWidth: 1, marginRight: t.right - 1 });
                    }),
                    (e.computeClippingRect = function (e) {
                        return I(e)
                            .map(function (e) {
                                return T(e);
                            })
                            .concat({ left: window.pageXOffset, right: window.pageXOffset + document.documentElement.clientWidth, top: window.pageYOffset, bottom: window.pageYOffset + document.documentElement.clientHeight })
                            .reduce(function (e, t) {
                                return S(e, t) || t;
                            });
                    }),
                    (e.computeEdges = w),
                    (e.computeFallbackHeaderFormat = An),
                    (e.computeHeightAndMargins = R),
                    (e.computeInnerRect = T),
                    (e.computeRect = C),
                    (e.computeVisibleDayRange = me),
                    (e.config = {}),
                    (e.constrainPoint = function (e, t) {
                        return { left: Math.min(Math.max(e.left, t.left), t.right), top: Math.min(Math.max(e.top, t.top), t.bottom) };
                    }),
                    (e.createDuration = X),
                    (e.createElement = n),
                    (e.createEmptyEventStore = xe),
                    (e.createEventInstance = Ft),
                    (e.createFormatter = nt),
                    (e.createPlugin = gr),
                    (e.cssToStr = Ht),
                    (e.debounce = pe),
                    (e.diffDates = ye),
                    (e.diffDayAndTime = z),
                    (e.diffDays = O),
                    (e.diffPoints = function (e, t) {
                        return { left: e.left - t.left, top: e.top - t.top };
                    }),
                    (e.diffWeeks = function (e, t) {
                        return O(e, t) / 7;
                    }),
                    (e.diffWholeDays = N),
                    (e.diffWholeWeeks = L),
                    (e.disableCursor = function () {
                        document.body.classList.add("fc-not-allowed");
                    }),
                    (e.distributeHeight = function (e, t, r) {
                        var n = Math.floor(t / e.length),
                            i = Math.floor(t - n * (e.length - 1)),
                            o = [],
                            s = [],
                            a = [],
                            l = 0;
                        ne(e),
                            e.forEach(function (t, r) {
                                var c = r === e.length - 1 ? i : n,
                                    u = R(t);
                                u < c ? (o.push(t), s.push(u), a.push(t.offsetHeight)) : (l += u);
                            }),
                            r && ((t -= l), (n = Math.floor(t / o.length)), (i = Math.floor(t - n * (o.length - 1)))),
                            o.forEach(function (e, t) {
                                var r = t === o.length - 1 ? i : n,
                                    l = s[t],
                                    c = a[t],
                                    u = r - (l - c);
                                l < r && (e.style.height = u + "px");
                            });
                    }),
                    (e.elementClosest = p),
                    (e.elementMatches = f),
                    (e.enableCursor = function () {
                        document.body.classList.remove("fc-not-allowed");
                    }),
                    (e.eventTupleToStore = Pe),
                    (e.filterEventStoreDefs = ze),
                    (e.filterHash = Te),
                    (e.findChildren = function (e, t) {
                        for (var r = e instanceof HTMLElement ? [e] : e, n = [], i = 0; i < r.length; i++)
                            for (var o = r[i].children, s = 0; s < o.length; s++) {
                                var a = o[s];
                                (t && !f(a, t)) || n.push(a);
                            }
                        return n;
                    }),
                    (e.findElements = g),
                    (e.flexibleCompare = ae),
                    (e.forceClassName = function (e, t, r) {
                        r ? e.classList.add(t) : e.classList.remove(t);
                    }),
                    (e.formatDate = function (e, t) {
                        void 0 === t && (t = {});
                        var r = zn(t),
                            n = nt(t),
                            i = r.createMarkerMeta(e);
                        return i ? r.format(i.marker, n, { forcedTzo: i.forcedTzo }) : "";
                    }),
                    (e.formatIsoTimeString = function (e) {
                        return ce(e.getUTCHours(), 2) + ":" + ce(e.getUTCMinutes(), 2) + ":" + ce(e.getUTCSeconds(), 2);
                    }),
                    (e.formatRange = function (e, t, r) {
                        var n = zn("object" == typeof r && r ? r : {}),
                            i = nt(r, Cr.defaultRangeSeparator),
                            o = n.createMarkerMeta(e),
                            s = n.createMarkerMeta(t);
                        return o && s ? n.formatRange(o.marker, s.marker, i, { forcedStartTzo: o.forcedTzo, forcedEndTzo: s.forcedTzo, isEndExclusive: r.isEndExclusive }) : "";
                    }),
                    (e.freezeRaw = ge),
                    (e.getAllDayHtml = function (e) {
                        return e.opt("allDayHtml") || Pt(e.opt("allDayText"));
                    }),
                    (e.getClippingParents = I),
                    (e.getDayClasses = $t),
                    (e.getElSeg = ht),
                    (e.getRectCenter = function (e) {
                        return { left: (e.left + e.right) / 2, top: (e.top + e.bottom) / 2 };
                    }),
                    (e.getRelevantEvents = ke),
                    (e.globalDefaults = Cr),
                    (e.greatestDurationDenominator = re),
                    (e.hasBgRendering = function (e) {
                        return "background" === e.rendering || "inverse-background" === e.rendering;
                    }),
                    (e.htmlEscape = Pt),
                    (e.htmlToElement = i),
                    (e.insertAfterElement = function (e, t) {
                        for (var r = c(t), n = e.nextSibling || null, i = 0; i < r.length; i++) e.parentNode.insertBefore(r[i], n);
                    }),
                    (e.interactionSettingsStore = Sn),
                    (e.interactionSettingsToStore = function (e) {
                        var t;
                        return ((t = {})[e.component.uid] = e), t;
                    }),
                    (e.intersectRanges = Ae),
                    (e.intersectRects = S),
                    (e.isArraysEqual = Fe),
                    (e.isDateSpansEqual = function (e, t) {
                        return (
                            Be(e.range, t.range) &&
                            e.allDay === t.allDay &&
                            (function (e, t) {
                                for (var r in t) if ("range" !== r && "allDay" !== r && e[r] !== t[r]) return !1;
                                for (var r in e) if (!(r in t)) return !1;
                                return !0;
                            })(e, t)
                        );
                    }),
                    (e.isInt = ue),
                    (e.isInteractionValid = Dt),
                    (e.isMultiDayRange = function (e) {
                        var t = me(e);
                        return O(t.start, t.end) > 1;
                    }),
                    (e.isObjectsSimilar = Zt),
                    (e.isPropsValid = Tt),
                    (e.isSingleDay = function (e) {
                        return 0 === e.years && 0 === e.months && 1 === e.days && 0 === e.milliseconds;
                    }),
                    (e.isValidDate = j),
                    (e.isValuesSimilar = qt),
                    (e.listenBySelector = P),
                    (e.mapHash = Ce),
                    (e.matchCellWidths = function (e) {
                        var t = 0;
                        return (
                            e.forEach(function (e) {
                                var r = e.firstChild;
                                if (r instanceof HTMLElement) {
                                    var n = r.offsetWidth;
                                    n > t && (t = n);
                                }
                            }),
                            t++,
                            e.forEach(function (e) {
                                e.style.width = t + "px";
                            }),
                            t
                        );
                    }),
                    (e.memoize = Ge),
                    (e.memoizeOutput = je),
                    (e.memoizeRendering = Yt),
                    (e.mergeEventStores = Oe),
                    (e.multiplyDuration = function (e, t) {
                        return { years: e.years * t, months: e.months * t, days: e.days * t, milliseconds: e.milliseconds * t };
                    }),
                    (e.padStart = ce),
                    (e.parseBusinessHours = jt),
                    (e.parseDragMeta = function (e) {
                        var t = {},
                            r = fe(e, Ln, Nn, t);
                        return (r.leftoverProps = t), r;
                    }),
                    (e.parseEventDef = Wt),
                    (e.parseFieldSpecs = ie),
                    (e.parseMarker = Br),
                    (e.pointInsideRect = function (e, t) {
                        return e.left >= t.left && e.left < t.right && e.top >= t.top && e.top < t.bottom;
                    }),
                    (e.prependToElement = l),
                    (e.preventContextMenu = function (e) {
                        e.addEventListener("contextmenu", M);
                    }),
                    (e.preventDefault = M),
                    (e.preventSelection = function (e) {
                        e.classList.add("fc-unselectable"), e.addEventListener("selectstart", M);
                    }),
                    (e.processScopedUiProps = Ot),
                    (e.rangeContainsMarker = We),
                    (e.rangeContainsRange = Ue),
                    (e.rangesEqual = Be),
                    (e.rangesIntersect = Ve),
                    (e.refineProps = fe),
                    (e.removeElement = u),
                    (e.removeExact = function (e, t) {
                        for (var r = 0, n = 0; n < e.length; ) e[n] === t ? (e.splice(n, 1), r++) : n++;
                        return r;
                    }),
                    (e.renderDateCell = Bn),
                    (e.requestJson = Sr),
                    (e.sliceEventStore = ct),
                    (e.startOfDay = A),
                    (e.subtractInnerElHeight = function (e, t) {
                        var r = { position: "relative", left: -1 };
                        m(e, r), m(t, r);
                        var n = e.offsetHeight - t.offsetHeight,
                            i = { position: "", left: "" };
                        return m(e, i), m(t, i), n;
                    }),
                    (e.translateRect = function (e, t, r) {
                        return { left: e.left + t, right: e.right + t, top: e.top + r, bottom: e.bottom + r };
                    }),
                    (e.uncompensateScroll = function (e) {
                        m(e, { marginLeft: "", marginRight: "", borderLeftWidth: "", borderRightWidth: "" });
                    }),
                    (e.undistributeHeight = ne),
                    (e.unpromisify = er),
                    (e.version = "4.0.2"),
                    (e.whenTransitionDone = function (e, t) {
                        var r = function (n) {
                            t(n),
                                H.forEach(function (t) {
                                    e.removeEventListener(t, r);
                                });
                        };
                        H.forEach(function (t) {
                            e.addEventListener(t, r);
                        });
                    }),
                    (e.wholeDivideDurations = function (e, t) {
                        for (var r = null, n = 0; n < q.length; n++) {
                            var i = q[n];
                            if (t[i]) {
                                var o = e[i] / t[i];
                                if (!ue(o) || (null !== r && r !== o)) return null;
                                r = o;
                            } else if (e[i]) return null;
                        }
                        return r;
                    }),
                    Object.defineProperty(e, "__esModule", { value: !0 });
            })(t);
        },
        250: function (e, t, r) {
            /*!
@fullcalendar/bootstrap v4.0.1
Docs & License: https://fullcalendar.io/
(c) 2019 Adam Shaw
*/
            !(function (e, t) {
                "use strict";
                /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */ var r = function (
                        e,
                        t
                    ) {
                        return (r =
                            Object.setPrototypeOf ||
                            ({ __proto__: [] } instanceof Array &&
                                function (e, t) {
                                    e.__proto__ = t;
                                }) ||
                            function (e, t) {
                                for (var r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                            })(e, t);
                    },
                    n = (function (e) {
                        function t() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            (function (e, t) {
                                function n() {
                                    this.constructor = e;
                                }
                                r(e, t), (e.prototype = null === t ? Object.create(t) : ((n.prototype = t.prototype), new n()));
                            })(t, e),
                            t
                        );
                    })(t.Theme);
                (n.prototype.classes = {
                    widget: "fc-bootstrap",
                    tableGrid: "table-bordered",
                    tableList: "table",
                    tableListHeading: "table-active",
                    buttonGroup: "btn-group",
                    button: "btn btn-primary",
                    buttonActive: "active",
                    today: "alert alert-info",
                    popover: "card card-primary",
                    popoverHeader: "card-header",
                    popoverContent: "card-body",
                    headerRow: "table-bordered",
                    dayRow: "table-bordered",
                    listView: "card card-primary",
                }),
                    (n.prototype.baseIconClass = "fa"),
                    (n.prototype.iconClasses = { close: "fa-times", prev: "fa-chevron-left", next: "fa-chevron-right", prevYear: "fa-angle-double-left", nextYear: "fa-angle-double-right" }),
                    (n.prototype.iconOverrideOption = "bootstrapFontAwesome"),
                    (n.prototype.iconOverrideCustomButtonOption = "bootstrapFontAwesome"),
                    (n.prototype.iconOverridePrefix = "fa-");
                var i = t.createPlugin({ themeClasses: { bootstrap: n } });
                (e.BootstrapTheme = n), (e.default = i), Object.defineProperty(e, "__esModule", { value: !0 });
            })(t, r(13));
        },
        251: function (e, t, r) {
            /*!
FullCalendar Interaction Plugin v4.0.2
Docs & License: https://fullcalendar.io/
(c) 2019 Adam Shaw
*/
            !(function (e, t) {
                "use strict";
                /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */ var r = function (
                    e,
                    t
                ) {
                    return (r =
                        Object.setPrototypeOf ||
                        ({ __proto__: [] } instanceof Array &&
                            function (e, t) {
                                e.__proto__ = t;
                            }) ||
                        function (e, t) {
                            for (var r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                        })(e, t);
                };
                function n(e, t) {
                    function n() {
                        this.constructor = e;
                    }
                    r(e, t), (e.prototype = null === t ? Object.create(t) : ((n.prototype = t.prototype), new n()));
                }
                var i = function () {
                    return (i =
                        Object.assign ||
                        function (e) {
                            for (var t, r = 1, n = arguments.length; r < n; r++) for (var i in (t = arguments[r])) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
                            return e;
                        }).apply(this, arguments);
                };
                t.config.touchMouseIgnoreWait = 500;
                var o = 0,
                    s = 0,
                    a = !1,
                    l = (function () {
                        function e(e) {
                            var r = this;
                            (this.subjectEl = null),
                                (this.downEl = null),
                                (this.selector = ""),
                                (this.handleSelector = ""),
                                (this.shouldIgnoreMove = !1),
                                (this.shouldWatchScroll = !0),
                                (this.isDragging = !1),
                                (this.isTouchDragging = !1),
                                (this.wasTouchScroll = !1),
                                (this.handleMouseDown = function (e) {
                                    if (
                                        !r.shouldIgnoreMouse() &&
                                        (function (e) {
                                            return 0 === e.button && !e.ctrlKey;
                                        })(e) &&
                                        r.tryStart(e)
                                    ) {
                                        var t = r.createEventFromMouse(e, !0);
                                        r.emitter.trigger("pointerdown", t), r.initScrollWatch(t), r.shouldIgnoreMove || document.addEventListener("mousemove", r.handleMouseMove), document.addEventListener("mouseup", r.handleMouseUp);
                                    }
                                }),
                                (this.handleMouseMove = function (e) {
                                    var t = r.createEventFromMouse(e);
                                    r.recordCoords(t), r.emitter.trigger("pointermove", t);
                                }),
                                (this.handleMouseUp = function (e) {
                                    document.removeEventListener("mousemove", r.handleMouseMove), document.removeEventListener("mouseup", r.handleMouseUp), r.emitter.trigger("pointerup", r.createEventFromMouse(e)), r.cleanup();
                                }),
                                (this.handleTouchStart = function (e) {
                                    if (r.tryStart(e)) {
                                        r.isTouchDragging = !0;
                                        var t = r.createEventFromTouch(e, !0);
                                        r.emitter.trigger("pointerdown", t), r.initScrollWatch(t);
                                        var n = e.target;
                                        r.shouldIgnoreMove || n.addEventListener("touchmove", r.handleTouchMove),
                                            n.addEventListener("touchend", r.handleTouchEnd),
                                            n.addEventListener("touchcancel", r.handleTouchEnd),
                                            window.addEventListener("scroll", r.handleTouchScroll, !0);
                                    }
                                }),
                                (this.handleTouchMove = function (e) {
                                    var t = r.createEventFromTouch(e);
                                    r.recordCoords(t), r.emitter.trigger("pointermove", t);
                                }),
                                (this.handleTouchEnd = function (e) {
                                    if (r.isDragging) {
                                        var n = e.target;
                                        n.removeEventListener("touchmove", r.handleTouchMove),
                                            n.removeEventListener("touchend", r.handleTouchEnd),
                                            n.removeEventListener("touchcancel", r.handleTouchEnd),
                                            window.removeEventListener("scroll", r.handleTouchScroll, !0),
                                            r.emitter.trigger("pointerup", r.createEventFromTouch(e)),
                                            r.cleanup(),
                                            (r.isTouchDragging = !1),
                                            o++,
                                            setTimeout(function () {
                                                o--;
                                            }, t.config.touchMouseIgnoreWait);
                                    }
                                }),
                                (this.handleTouchScroll = function () {
                                    r.wasTouchScroll = !0;
                                }),
                                (this.handleScroll = function (e) {
                                    if (!r.shouldIgnoreMove) {
                                        var t = window.pageXOffset - r.prevScrollX + r.prevPageX,
                                            n = window.pageYOffset - r.prevScrollY + r.prevPageY;
                                        r.emitter.trigger("pointermove", { origEvent: e, isTouch: r.isTouchDragging, subjectEl: r.subjectEl, pageX: t, pageY: n, deltaX: t - r.origPageX, deltaY: n - r.origPageY });
                                    }
                                }),
                                (this.containerEl = e),
                                (this.emitter = new t.EmitterMixin()),
                                e.addEventListener("mousedown", this.handleMouseDown),
                                e.addEventListener("touchstart", this.handleTouchStart, { passive: !0 }),
                                s++ || window.addEventListener("touchmove", c, { passive: !1 });
                        }
                        return (
                            (e.prototype.destroy = function () {
                                this.containerEl.removeEventListener("mousedown", this.handleMouseDown),
                                    this.containerEl.removeEventListener("touchstart", this.handleTouchStart, { passive: !0 }),
                                    --s || window.removeEventListener("touchmove", c, { passive: !1 });
                            }),
                            (e.prototype.tryStart = function (e) {
                                var r = this.querySubjectEl(e),
                                    n = e.target;
                                return !(!r || (this.handleSelector && !t.elementClosest(n, this.handleSelector)) || ((this.subjectEl = r), (this.downEl = n), (this.isDragging = !0), (this.wasTouchScroll = !1), 0));
                            }),
                            (e.prototype.cleanup = function () {
                                (a = !1), (this.isDragging = !1), (this.subjectEl = null), (this.downEl = null), this.destroyScrollWatch();
                            }),
                            (e.prototype.querySubjectEl = function (e) {
                                return this.selector ? t.elementClosest(e.target, this.selector) : this.containerEl;
                            }),
                            (e.prototype.shouldIgnoreMouse = function () {
                                return o || this.isTouchDragging;
                            }),
                            (e.prototype.cancelTouchScroll = function () {
                                this.isDragging && (a = !0);
                            }),
                            (e.prototype.initScrollWatch = function (e) {
                                this.shouldWatchScroll && (this.recordCoords(e), window.addEventListener("scroll", this.handleScroll, !0));
                            }),
                            (e.prototype.recordCoords = function (e) {
                                this.shouldWatchScroll && ((this.prevPageX = e.pageX), (this.prevPageY = e.pageY), (this.prevScrollX = window.pageXOffset), (this.prevScrollY = window.pageYOffset));
                            }),
                            (e.prototype.destroyScrollWatch = function () {
                                this.shouldWatchScroll && window.removeEventListener("scroll", this.handleScroll, !0);
                            }),
                            (e.prototype.createEventFromMouse = function (e, t) {
                                var r = 0,
                                    n = 0;
                                return (
                                    t ? ((this.origPageX = e.pageX), (this.origPageY = e.pageY)) : ((r = e.pageX - this.origPageX), (n = e.pageY - this.origPageY)),
                                    { origEvent: e, isTouch: !1, subjectEl: this.subjectEl, pageX: e.pageX, pageY: e.pageY, deltaX: r, deltaY: n }
                                );
                            }),
                            (e.prototype.createEventFromTouch = function (e, t) {
                                var r,
                                    n,
                                    i = e.touches,
                                    o = 0,
                                    s = 0;
                                return (
                                    i && i.length ? ((r = i[0].pageX), (n = i[0].pageY)) : ((r = e.pageX), (n = e.pageY)),
                                    t ? ((this.origPageX = r), (this.origPageY = n)) : ((o = r - this.origPageX), (s = n - this.origPageY)),
                                    { origEvent: e, isTouch: !0, subjectEl: this.subjectEl, pageX: r, pageY: n, deltaX: o, deltaY: s }
                                );
                            }),
                            e
                        );
                    })();
                function c(e) {
                    a && e.preventDefault();
                }
                var u = (function () {
                        function e() {
                            (this.isVisible = !1), (this.sourceEl = null), (this.mirrorEl = null), (this.sourceElRect = null), (this.parentNode = document.body), (this.zIndex = 9999), (this.revertDuration = 0);
                        }
                        return (
                            (e.prototype.start = function (e, t, r) {
                                (this.sourceEl = e),
                                    (this.sourceElRect = this.sourceEl.getBoundingClientRect()),
                                    (this.origScreenX = t - window.pageXOffset),
                                    (this.origScreenY = r - window.pageYOffset),
                                    (this.deltaX = 0),
                                    (this.deltaY = 0),
                                    this.updateElPosition();
                            }),
                            (e.prototype.handleMove = function (e, t) {
                                (this.deltaX = e - window.pageXOffset - this.origScreenX), (this.deltaY = t - window.pageYOffset - this.origScreenY), this.updateElPosition();
                            }),
                            (e.prototype.setIsVisible = function (e) {
                                e
                                    ? this.isVisible || (this.mirrorEl && (this.mirrorEl.style.display = ""), (this.isVisible = e), this.updateElPosition())
                                    : this.isVisible && (this.mirrorEl && (this.mirrorEl.style.display = "none"), (this.isVisible = e));
                            }),
                            (e.prototype.stop = function (e, t) {
                                var r = this,
                                    n = function () {
                                        r.cleanup(), t();
                                    };
                                e && this.mirrorEl && this.isVisible && this.revertDuration && (this.deltaX || this.deltaY) ? this.doRevertAnimation(n, this.revertDuration) : setTimeout(n, 0);
                            }),
                            (e.prototype.doRevertAnimation = function (e, r) {
                                var n = this.mirrorEl,
                                    i = this.sourceEl.getBoundingClientRect();
                                (n.style.transition = "top " + r + "ms,left " + r + "ms"),
                                    t.applyStyle(n, { left: i.left, top: i.top }),
                                    t.whenTransitionDone(n, function () {
                                        (n.style.transition = ""), e();
                                    });
                            }),
                            (e.prototype.cleanup = function () {
                                this.mirrorEl && (t.removeElement(this.mirrorEl), (this.mirrorEl = null)), (this.sourceEl = null);
                            }),
                            (e.prototype.updateElPosition = function () {
                                this.sourceEl && this.isVisible && t.applyStyle(this.getMirrorEl(), { left: this.sourceElRect.left + this.deltaX, top: this.sourceElRect.top + this.deltaY });
                            }),
                            (e.prototype.getMirrorEl = function () {
                                var e = this.sourceElRect,
                                    r = this.mirrorEl;
                                return (
                                    r ||
                                        ((r = this.mirrorEl = this.sourceEl.cloneNode(!0)).classList.add("fc-unselectable"),
                                        r.classList.add("fc-dragging"),
                                        t.applyStyle(r, { position: "fixed", zIndex: this.zIndex, visibility: "", boxSizing: "border-box", width: e.right - e.left, height: e.bottom - e.top, right: "auto", bottom: "auto", margin: 0 }),
                                        this.parentNode.appendChild(r)),
                                    r
                                );
                            }),
                            e
                        );
                    })(),
                    d = (function (e) {
                        function t(t, r) {
                            var n = e.call(this) || this;
                            return (
                                (n.handleScroll = function () {
                                    (n.scrollTop = n.scrollController.getScrollTop()), (n.scrollLeft = n.scrollController.getScrollLeft()), n.handleScrollChange();
                                }),
                                (n.scrollController = t),
                                (n.doesListening = r),
                                (n.scrollTop = n.origScrollTop = t.getScrollTop()),
                                (n.scrollLeft = n.origScrollLeft = t.getScrollLeft()),
                                (n.scrollWidth = t.getScrollWidth()),
                                (n.scrollHeight = t.getScrollHeight()),
                                (n.clientWidth = t.getClientWidth()),
                                (n.clientHeight = t.getClientHeight()),
                                (n.clientRect = n.computeClientRect()),
                                n.doesListening && n.getEventTarget().addEventListener("scroll", n.handleScroll),
                                n
                            );
                        }
                        return (
                            n(t, e),
                            (t.prototype.destroy = function () {
                                this.doesListening && this.getEventTarget().removeEventListener("scroll", this.handleScroll);
                            }),
                            (t.prototype.getScrollTop = function () {
                                return this.scrollTop;
                            }),
                            (t.prototype.getScrollLeft = function () {
                                return this.scrollLeft;
                            }),
                            (t.prototype.setScrollTop = function (e) {
                                this.scrollController.setScrollTop(e), this.doesListening || ((this.scrollTop = Math.max(Math.min(e, this.getMaxScrollTop()), 0)), this.handleScrollChange());
                            }),
                            (t.prototype.setScrollLeft = function (e) {
                                this.scrollController.setScrollLeft(e), this.doesListening || ((this.scrollLeft = Math.max(Math.min(e, this.getMaxScrollLeft()), 0)), this.handleScrollChange());
                            }),
                            (t.prototype.getClientWidth = function () {
                                return this.clientWidth;
                            }),
                            (t.prototype.getClientHeight = function () {
                                return this.clientHeight;
                            }),
                            (t.prototype.getScrollWidth = function () {
                                return this.scrollWidth;
                            }),
                            (t.prototype.getScrollHeight = function () {
                                return this.scrollHeight;
                            }),
                            (t.prototype.handleScrollChange = function () {}),
                            t
                        );
                    })(t.ScrollController),
                    h = (function (e) {
                        function r(r, n) {
                            return e.call(this, new t.ElementScrollController(r), n) || this;
                        }
                        return (
                            n(r, e),
                            (r.prototype.getEventTarget = function () {
                                return this.scrollController.el;
                            }),
                            (r.prototype.computeClientRect = function () {
                                return t.computeInnerRect(this.scrollController.el);
                            }),
                            r
                        );
                    })(d),
                    p = (function (e) {
                        function r(r) {
                            return e.call(this, new t.WindowScrollController(), r) || this;
                        }
                        return (
                            n(r, e),
                            (r.prototype.getEventTarget = function () {
                                return window;
                            }),
                            (r.prototype.computeClientRect = function () {
                                return { left: this.scrollLeft, right: this.scrollLeft + this.clientWidth, top: this.scrollTop, bottom: this.scrollTop + this.clientHeight };
                            }),
                            (r.prototype.handleScrollChange = function () {
                                this.clientRect = this.computeClientRect();
                            }),
                            r
                        );
                    })(d),
                    f = "function" == typeof performance ? performance.now : Date.now,
                    g = (function () {
                        function e() {
                            var e = this;
                            (this.isEnabled = !0),
                                (this.scrollQuery = [window, ".fc-scroller"]),
                                (this.edgeThreshold = 50),
                                (this.maxVelocity = 300),
                                (this.pointerScreenX = null),
                                (this.pointerScreenY = null),
                                (this.isAnimating = !1),
                                (this.scrollCaches = null),
                                (this.everMovedUp = !1),
                                (this.everMovedDown = !1),
                                (this.everMovedLeft = !1),
                                (this.everMovedRight = !1),
                                (this.animate = function () {
                                    if (e.isAnimating) {
                                        var t = e.computeBestEdge(e.pointerScreenX + window.pageXOffset, e.pointerScreenY + window.pageYOffset);
                                        if (t) {
                                            var r = f();
                                            e.handleSide(t, (r - e.msSinceRequest) / 1e3), e.requestAnimation(r);
                                        } else e.isAnimating = !1;
                                    }
                                });
                        }
                        return (
                            (e.prototype.start = function (e, t) {
                                this.isEnabled &&
                                    ((this.scrollCaches = this.buildCaches()),
                                    (this.pointerScreenX = null),
                                    (this.pointerScreenY = null),
                                    (this.everMovedUp = !1),
                                    (this.everMovedDown = !1),
                                    (this.everMovedLeft = !1),
                                    (this.everMovedRight = !1),
                                    this.handleMove(e, t));
                            }),
                            (e.prototype.handleMove = function (e, t) {
                                if (this.isEnabled) {
                                    var r = e - window.pageXOffset,
                                        n = t - window.pageYOffset,
                                        i = null === this.pointerScreenY ? 0 : n - this.pointerScreenY,
                                        o = null === this.pointerScreenX ? 0 : r - this.pointerScreenX;
                                    i < 0 ? (this.everMovedUp = !0) : i > 0 && (this.everMovedDown = !0),
                                        o < 0 ? (this.everMovedLeft = !0) : o > 0 && (this.everMovedRight = !0),
                                        (this.pointerScreenX = r),
                                        (this.pointerScreenY = n),
                                        this.isAnimating || ((this.isAnimating = !0), this.requestAnimation(f()));
                                }
                            }),
                            (e.prototype.stop = function () {
                                if (this.isEnabled) {
                                    this.isAnimating = !1;
                                    for (var e = 0, t = this.scrollCaches; e < t.length; e++) {
                                        var r = t[e];
                                        r.destroy();
                                    }
                                    this.scrollCaches = null;
                                }
                            }),
                            (e.prototype.requestAnimation = function (e) {
                                (this.msSinceRequest = e), requestAnimationFrame(this.animate);
                            }),
                            (e.prototype.handleSide = function (e, t) {
                                var r = e.scrollCache,
                                    n = this.edgeThreshold,
                                    i = n - e.distance,
                                    o = ((i * i) / (n * n)) * this.maxVelocity * t,
                                    s = 1;
                                switch (e.name) {
                                    case "left":
                                        s = -1;
                                    case "right":
                                        r.setScrollLeft(r.getScrollLeft() + o * s);
                                        break;
                                    case "top":
                                        s = -1;
                                    case "bottom":
                                        r.setScrollTop(r.getScrollTop() + o * s);
                                }
                            }),
                            (e.prototype.computeBestEdge = function (e, t) {
                                for (var r = this.edgeThreshold, n = null, i = 0, o = this.scrollCaches; i < o.length; i++) {
                                    var s = o[i],
                                        a = s.clientRect,
                                        l = e - a.left,
                                        c = a.right - e,
                                        u = t - a.top,
                                        d = a.bottom - t;
                                    l >= 0 &&
                                        c >= 0 &&
                                        u >= 0 &&
                                        d >= 0 &&
                                        (u <= r && this.everMovedUp && s.canScrollUp() && (!n || n.distance > u) && (n = { scrollCache: s, name: "top", distance: u }),
                                        d <= r && this.everMovedDown && s.canScrollDown() && (!n || n.distance > d) && (n = { scrollCache: s, name: "bottom", distance: d }),
                                        l <= r && this.everMovedLeft && s.canScrollLeft() && (!n || n.distance > l) && (n = { scrollCache: s, name: "left", distance: l }),
                                        c <= r && this.everMovedRight && s.canScrollRight() && (!n || n.distance > c) && (n = { scrollCache: s, name: "right", distance: c }));
                                }
                                return n;
                            }),
                            (e.prototype.buildCaches = function () {
                                return this.queryScrollEls().map(function (e) {
                                    return e === window ? new p(!1) : new h(e, !1);
                                });
                            }),
                            (e.prototype.queryScrollEls = function () {
                                for (var e = [], t = 0, r = this.scrollQuery; t < r.length; t++) {
                                    var n = r[t];
                                    "object" == typeof n ? e.push(n) : e.push.apply(e, Array.prototype.slice.call(document.querySelectorAll(n)));
                                }
                                return e;
                            }),
                            e
                        );
                    })(),
                    v = (function (e) {
                        function r(r) {
                            var n = e.call(this, r) || this;
                            (n.delay = null),
                                (n.minDistance = 0),
                                (n.touchScrollAllowed = !0),
                                (n.mirrorNeedsRevert = !1),
                                (n.isInteracting = !1),
                                (n.isDragging = !1),
                                (n.isDelayEnded = !1),
                                (n.isDistanceSurpassed = !1),
                                (n.delayTimeoutId = null),
                                (n.onPointerDown = function (e) {
                                    n.isDragging ||
                                        ((n.isInteracting = !0),
                                        (n.isDelayEnded = !1),
                                        (n.isDistanceSurpassed = !1),
                                        t.preventSelection(document.body),
                                        t.preventContextMenu(document.body),
                                        e.isTouch || e.origEvent.preventDefault(),
                                        n.emitter.trigger("pointerdown", e),
                                        n.pointer.shouldIgnoreMove || (n.mirror.setIsVisible(!1), n.mirror.start(e.subjectEl, e.pageX, e.pageY), n.startDelay(e), n.minDistance || n.handleDistanceSurpassed(e)));
                                }),
                                (n.onPointerMove = function (e) {
                                    if (n.isInteracting) {
                                        if ((n.emitter.trigger("pointermove", e), !n.isDistanceSurpassed)) {
                                            var t = n.minDistance,
                                                r = e.deltaX,
                                                i = e.deltaY;
                                            r * r + i * i >= t * t && n.handleDistanceSurpassed(e);
                                        }
                                        n.isDragging && ("scroll" !== e.origEvent.type && (n.mirror.handleMove(e.pageX, e.pageY), n.autoScroller.handleMove(e.pageX, e.pageY)), n.emitter.trigger("dragmove", e));
                                    }
                                }),
                                (n.onPointerUp = function (e) {
                                    n.isInteracting &&
                                        ((n.isInteracting = !1),
                                        t.allowSelection(document.body),
                                        t.allowContextMenu(document.body),
                                        n.emitter.trigger("pointerup", e),
                                        n.isDragging && (n.autoScroller.stop(), n.tryStopDrag(e)),
                                        n.delayTimeoutId && (clearTimeout(n.delayTimeoutId), (n.delayTimeoutId = null)));
                                });
                            var i = (n.pointer = new l(r));
                            return i.emitter.on("pointerdown", n.onPointerDown), i.emitter.on("pointermove", n.onPointerMove), i.emitter.on("pointerup", n.onPointerUp), (n.mirror = new u()), (n.autoScroller = new g()), n;
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                this.pointer.destroy();
                            }),
                            (r.prototype.startDelay = function (e) {
                                var t = this;
                                "number" == typeof this.delay
                                    ? (this.delayTimeoutId = setTimeout(function () {
                                          (t.delayTimeoutId = null), t.handleDelayEnd(e);
                                      }, this.delay))
                                    : this.handleDelayEnd(e);
                            }),
                            (r.prototype.handleDelayEnd = function (e) {
                                (this.isDelayEnded = !0), this.tryStartDrag(e);
                            }),
                            (r.prototype.handleDistanceSurpassed = function (e) {
                                (this.isDistanceSurpassed = !0), this.tryStartDrag(e);
                            }),
                            (r.prototype.tryStartDrag = function (e) {
                                this.isDelayEnded &&
                                    this.isDistanceSurpassed &&
                                    ((this.pointer.wasTouchScroll && !this.touchScrollAllowed) ||
                                        ((this.isDragging = !0),
                                        (this.mirrorNeedsRevert = !1),
                                        this.autoScroller.start(e.pageX, e.pageY),
                                        this.emitter.trigger("dragstart", e),
                                        !1 === this.touchScrollAllowed && this.pointer.cancelTouchScroll()));
                            }),
                            (r.prototype.tryStopDrag = function (e) {
                                this.mirror.stop(this.mirrorNeedsRevert, this.stopDrag.bind(this, e));
                            }),
                            (r.prototype.stopDrag = function (e) {
                                (this.isDragging = !1), this.emitter.trigger("dragend", e);
                            }),
                            (r.prototype.setIgnoreMove = function (e) {
                                this.pointer.shouldIgnoreMove = e;
                            }),
                            (r.prototype.setMirrorIsVisible = function (e) {
                                this.mirror.setIsVisible(e);
                            }),
                            (r.prototype.setMirrorNeedsRevert = function (e) {
                                this.mirrorNeedsRevert = e;
                            }),
                            (r.prototype.setAutoScrollEnabled = function (e) {
                                this.autoScroller.isEnabled = e;
                            }),
                            r
                        );
                    })(t.ElementDragging),
                    m = (function () {
                        function e(e) {
                            (this.origRect = t.computeRect(e)),
                                (this.scrollCaches = t.getClippingParents(e).map(function (e) {
                                    return new h(e, !0);
                                }));
                        }
                        return (
                            (e.prototype.destroy = function () {
                                for (var e = 0, t = this.scrollCaches; e < t.length; e++) {
                                    var r = t[e];
                                    r.destroy();
                                }
                            }),
                            (e.prototype.computeLeft = function () {
                                for (var e = this.origRect.left, t = 0, r = this.scrollCaches; t < r.length; t++) {
                                    var n = r[t];
                                    e += n.origScrollLeft - n.getScrollLeft();
                                }
                                return e;
                            }),
                            (e.prototype.computeTop = function () {
                                for (var e = this.origRect.top, t = 0, r = this.scrollCaches; t < r.length; t++) {
                                    var n = r[t];
                                    e += n.origScrollTop - n.getScrollTop();
                                }
                                return e;
                            }),
                            (e.prototype.isWithinClipping = function (e, r) {
                                for (var n, i, o = { left: e, top: r }, s = 0, a = this.scrollCaches; s < a.length; s++) {
                                    var l = a[s];
                                    if (((n = l.getEventTarget()), (i = void 0), "HTML" !== (i = n.tagName) && "BODY" !== i && !t.pointInsideRect(o, l.clientRect))) return !1;
                                }
                                return !0;
                            }),
                            e
                        );
                    })(),
                    y = (function () {
                        function e(e, r) {
                            var n = this;
                            (this.useSubjectCenter = !1),
                                (this.requireInitial = !0),
                                (this.initialHit = null),
                                (this.movingHit = null),
                                (this.finalHit = null),
                                (this.handlePointerDown = function (e) {
                                    var t = n.dragging;
                                    (n.initialHit = null),
                                        (n.movingHit = null),
                                        (n.finalHit = null),
                                        n.prepareHits(),
                                        n.processFirstCoord(e),
                                        n.initialHit || !n.requireInitial ? (t.setIgnoreMove(!1), n.emitter.trigger("pointerdown", e)) : t.setIgnoreMove(!0);
                                }),
                                (this.handleDragStart = function (e) {
                                    n.emitter.trigger("dragstart", e), n.handleMove(e, !0);
                                }),
                                (this.handleDragMove = function (e) {
                                    n.emitter.trigger("dragmove", e), n.handleMove(e);
                                }),
                                (this.handlePointerUp = function (e) {
                                    n.releaseHits(), n.emitter.trigger("pointerup", e);
                                }),
                                (this.handleDragEnd = function (e) {
                                    n.movingHit && n.emitter.trigger("hitupdate", null, !0, e), (n.finalHit = n.movingHit), (n.movingHit = null), n.emitter.trigger("dragend", e);
                                }),
                                (this.droppableStore = r),
                                e.emitter.on("pointerdown", this.handlePointerDown),
                                e.emitter.on("dragstart", this.handleDragStart),
                                e.emitter.on("dragmove", this.handleDragMove),
                                e.emitter.on("pointerup", this.handlePointerUp),
                                e.emitter.on("dragend", this.handleDragEnd),
                                (this.dragging = e),
                                (this.emitter = new t.EmitterMixin());
                        }
                        return (
                            (e.prototype.processFirstCoord = function (e) {
                                var r,
                                    n = { left: e.pageX, top: e.pageY },
                                    i = n,
                                    o = e.subjectEl;
                                o !== document && ((r = t.computeRect(o)), (i = t.constrainPoint(i, r)));
                                var s = (this.initialHit = this.queryHitForOffset(i.left, i.top));
                                if (s) {
                                    if (this.useSubjectCenter && r) {
                                        var a = t.intersectRects(r, s.rect);
                                        a && (i = t.getRectCenter(a));
                                    }
                                    this.coordAdjust = t.diffPoints(i, n);
                                } else this.coordAdjust = { left: 0, top: 0 };
                            }),
                            (e.prototype.handleMove = function (e, t) {
                                var r = this.queryHitForOffset(e.pageX + this.coordAdjust.left, e.pageY + this.coordAdjust.top);
                                (!t && S(this.movingHit, r)) || ((this.movingHit = r), this.emitter.trigger("hitupdate", r, !1, e));
                            }),
                            (e.prototype.prepareHits = function () {
                                this.offsetTrackers = t.mapHash(this.droppableStore, function (e) {
                                    return new m(e.el);
                                });
                            }),
                            (e.prototype.releaseHits = function () {
                                var e = this.offsetTrackers;
                                for (var t in e) e[t].destroy();
                                this.offsetTrackers = {};
                            }),
                            (e.prototype.queryHitForOffset = function (e, r) {
                                var n = this.droppableStore,
                                    i = this.offsetTrackers,
                                    o = null;
                                for (var s in n) {
                                    var a = n[s].component,
                                        l = i[s];
                                    if (l.isWithinClipping(e, r)) {
                                        var c = l.computeLeft(),
                                            u = l.computeTop(),
                                            d = e - c,
                                            h = r - u,
                                            p = l.origRect,
                                            f = p.right - p.left,
                                            g = p.bottom - p.top;
                                        if (d >= 0 && d < f && h >= 0 && h < g) {
                                            var v = a.queryHit(d, h, f, g);
                                            !v ||
                                                (a.props.dateProfile && !t.rangeContainsRange(a.props.dateProfile.activeRange, v.dateSpan.range)) ||
                                                (o && !(v.layer > o.layer)) ||
                                                ((v.rect.left += c), (v.rect.right += c), (v.rect.top += u), (v.rect.bottom += u), (o = v));
                                        }
                                    }
                                }
                                return o;
                            }),
                            e
                        );
                    })();
                function S(e, r) {
                    return (!e && !r) || (Boolean(e) === Boolean(r) && t.isDateSpansEqual(e.dateSpan, r.dateSpan));
                }
                var E = (function (e) {
                        function r(r) {
                            var n = e.call(this, r) || this;
                            (n.handlePointerDown = function (e) {
                                var t = n.dragging;
                                t.setIgnoreMove(!n.component.isValidDateDownEl(t.pointer.downEl));
                            }),
                                (n.handleDragEnd = function (e) {
                                    var t = n.component,
                                        r = n.dragging.pointer;
                                    if (!r.wasTouchScroll) {
                                        var i = n.hitDragging,
                                            o = i.initialHit,
                                            s = i.finalHit;
                                        o && s && S(o, s) && t.calendar.triggerDateClick(o.dateSpan, o.dayEl, t.view, e.origEvent);
                                    }
                                });
                            var i = r.component;
                            (n.dragging = new v(i.el)), (n.dragging.autoScroller.isEnabled = !1);
                            var o = (n.hitDragging = new y(n.dragging, t.interactionSettingsToStore(r)));
                            return o.emitter.on("pointerdown", n.handlePointerDown), o.emitter.on("dragend", n.handleDragEnd), n;
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                this.dragging.destroy();
                            }),
                            r
                        );
                    })(t.Interaction),
                    b = (function (e) {
                        function r(r) {
                            var n = e.call(this, r) || this;
                            (n.dragSelection = null),
                                (n.handlePointerDown = function (e) {
                                    var t = n,
                                        r = t.component,
                                        i = t.dragging,
                                        o = r.opt("selectable") && r.isValidDateDownEl(e.origEvent.target);
                                    i.setIgnoreMove(!o),
                                        (i.delay = e.isTouch
                                            ? (function (e) {
                                                  var t = e.opt("selectLongPressDelay");
                                                  return null == t && (t = e.opt("longPressDelay")), t;
                                              })(r)
                                            : null);
                                }),
                                (n.handleDragStart = function (e) {
                                    n.component.calendar.unselect(e);
                                }),
                                (n.handleHitUpdate = function (e, r) {
                                    var o = n.component.calendar,
                                        s = null,
                                        a = !1;
                                    e &&
                                        (((s = (function (e, r, n) {
                                            var o = e.dateSpan,
                                                s = r.dateSpan,
                                                a = [o.range.start, o.range.end, s.range.start, s.range.end];
                                            a.sort(t.compareNumbers);
                                            for (var l = {}, c = 0, u = n; c < u.length; c++) {
                                                var d = u[c],
                                                    h = d(e, r);
                                                if (!1 === h) return null;
                                                h && i(l, h);
                                            }
                                            return (l.range = { start: a[0], end: a[3] }), (l.allDay = o.allDay), l;
                                        })(n.hitDragging.initialHit, e, o.pluginSystem.hooks.dateSelectionTransformers)) &&
                                            n.component.isDateSelectionValid(s)) ||
                                            ((a = !0), (s = null))),
                                        s ? o.dispatch({ type: "SELECT_DATES", selection: s }) : r || o.dispatch({ type: "UNSELECT_DATES" }),
                                        a ? t.disableCursor() : t.enableCursor(),
                                        r || (n.dragSelection = s);
                                }),
                                (n.handlePointerUp = function (e) {
                                    n.dragSelection && (n.component.calendar.triggerDateSelect(n.dragSelection, e), (n.dragSelection = null));
                                });
                            var o = r.component,
                                s = (n.dragging = new v(o.el));
                            (s.touchScrollAllowed = !1), (s.minDistance = o.opt("selectMinDistance") || 0), (s.autoScroller.isEnabled = o.opt("dragScroll"));
                            var a = (n.hitDragging = new y(n.dragging, t.interactionSettingsToStore(r)));
                            return a.emitter.on("pointerdown", n.handlePointerDown), a.emitter.on("dragstart", n.handleDragStart), a.emitter.on("hitupdate", n.handleHitUpdate), a.emitter.on("pointerup", n.handlePointerUp), n;
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                this.dragging.destroy();
                            }),
                            r
                        );
                    })(t.Interaction),
                    D = (function (e) {
                        function r(n) {
                            var o = e.call(this, n) || this;
                            (o.subjectSeg = null),
                                (o.isDragging = !1),
                                (o.eventRange = null),
                                (o.relevantEvents = null),
                                (o.receivingCalendar = null),
                                (o.validMutation = null),
                                (o.mutatedRelevantEvents = null),
                                (o.handlePointerDown = function (e) {
                                    var r = e.origEvent.target,
                                        n = o,
                                        i = n.component,
                                        s = n.dragging,
                                        a = s.mirror,
                                        l = i.calendar,
                                        c = (o.subjectSeg = t.getElSeg(e.subjectEl)),
                                        u = (o.eventRange = c.eventRange),
                                        d = u.instance.instanceId;
                                    (o.relevantEvents = t.getRelevantEvents(l.state.eventStore, d)),
                                        (s.minDistance = e.isTouch ? 0 : i.opt("eventDragMinDistance")),
                                        (s.delay =
                                            e.isTouch && d !== i.props.eventSelection
                                                ? (function (e) {
                                                      var t = e.opt("eventLongPressDelay");
                                                      return null == t && (t = e.opt("longPressDelay")), t;
                                                  })(i)
                                                : null),
                                        (a.parentNode = l.el),
                                        (a.revertDuration = i.opt("dragRevertDuration"));
                                    var h = i.isValidSegDownEl(r) && !t.elementClosest(r, ".fc-resizer");
                                    s.setIgnoreMove(!h), (o.isDragging = h && e.subjectEl.classList.contains("fc-draggable"));
                                }),
                                (o.handleDragStart = function (e) {
                                    var r = o.component.calendar,
                                        n = o.eventRange,
                                        i = n.instance.instanceId;
                                    e.isTouch ? i !== o.component.props.eventSelection && r.dispatch({ type: "SELECT_EVENT", eventInstanceId: i }) : r.dispatch({ type: "UNSELECT_EVENT" }),
                                        o.isDragging && (r.unselect(e), r.publiclyTrigger("eventDragStart", [{ el: o.subjectSeg.el, event: new t.EventApi(r, n.def, n.instance), jsEvent: e.origEvent, view: o.component.view }]));
                                }),
                                (o.handleHitUpdate = function (e, r) {
                                    if (o.isDragging) {
                                        var n = o.relevantEvents,
                                            i = o.hitDragging.initialHit,
                                            s = o.component.calendar,
                                            a = null,
                                            l = null,
                                            c = null,
                                            u = !1,
                                            d = { affectedEvents: n, mutatedEvents: t.createEmptyEventStore(), isEvent: !0, origSeg: o.subjectSeg };
                                        if (e) {
                                            var h = e.component;
                                            (a = h.calendar),
                                                s === a || (h.opt("editable") && h.opt("droppable"))
                                                    ? (l = (function (e, r, n) {
                                                          var i = e.dateSpan,
                                                              o = r.dateSpan,
                                                              s = i.range.start,
                                                              a = o.range.start,
                                                              l = {};
                                                          i.allDay !== o.allDay && ((l.allDay = o.allDay), (l.hasEnd = r.component.opt("allDayMaintainDuration")), o.allDay && (s = t.startOfDay(s)));
                                                          var c = t.diffDates(s, a, e.component.dateEnv, e.component === r.component ? e.component.largeUnit : null);
                                                          c.milliseconds && (l.allDay = !1);
                                                          for (var u = { startDelta: c, endDelta: c, standardProps: l }, d = 0, h = n; d < h.length; d++) {
                                                              var p = h[d];
                                                              p(u, e, r);
                                                          }
                                                          return u;
                                                      })(i, e, a.pluginSystem.hooks.eventDragMutationMassagers)) &&
                                                      ((c = t.applyMutationToEventStore(n, a.eventUiBases, l, a)),
                                                      (d.mutatedEvents = c),
                                                      h.isInteractionValid(d) || ((u = !0), (l = null), (c = null), (d.mutatedEvents = t.createEmptyEventStore())))
                                                    : (a = null);
                                        }
                                        o.displayDrag(a, d),
                                            u ? t.disableCursor() : t.enableCursor(),
                                            r ||
                                                (s === a && S(i, e) && (l = null),
                                                o.dragging.setMirrorNeedsRevert(!l),
                                                o.dragging.setMirrorIsVisible(!e || !document.querySelector(".fc-mirror")),
                                                (o.receivingCalendar = a),
                                                (o.validMutation = l),
                                                (o.mutatedRelevantEvents = c));
                                    }
                                }),
                                (o.handlePointerUp = function () {
                                    o.isDragging || o.cleanup();
                                }),
                                (o.handleDragEnd = function (e) {
                                    if (o.isDragging) {
                                        var r = o.component.calendar,
                                            n = o.component.view,
                                            s = o.receivingCalendar,
                                            a = o.eventRange.def,
                                            l = o.eventRange.instance,
                                            c = new t.EventApi(r, a, l),
                                            u = o.relevantEvents,
                                            d = o.mutatedRelevantEvents,
                                            h = o.hitDragging.finalHit;
                                        if ((o.clearDrag(), r.publiclyTrigger("eventDragStop", [{ el: o.subjectSeg.el, event: c, jsEvent: e.origEvent, view: n }]), o.validMutation)) {
                                            if (s === r) {
                                                r.dispatch({ type: "MERGE_EVENTS", eventStore: d });
                                                for (var p = {}, f = 0, g = r.pluginSystem.hooks.eventDropTransformers; f < g.length; f++) {
                                                    var v = g[f];
                                                    i(p, v(o.validMutation, r));
                                                }
                                                i(p, {
                                                    el: e.subjectEl,
                                                    delta: o.validMutation.startDelta,
                                                    oldEvent: c,
                                                    event: new t.EventApi(r, d.defs[a.defId], l ? d.instances[l.instanceId] : null),
                                                    revert: function () {
                                                        r.dispatch({ type: "MERGE_EVENTS", eventStore: u });
                                                    },
                                                    jsEvent: e.origEvent,
                                                    view: n,
                                                }),
                                                    r.publiclyTrigger("eventDrop", [p]);
                                            } else if (s) {
                                                r.publiclyTrigger("eventLeave", [{ draggedEl: e.subjectEl, event: c, view: n }]),
                                                    r.dispatch({ type: "REMOVE_EVENT_INSTANCES", instances: o.mutatedRelevantEvents.instances }),
                                                    s.dispatch({ type: "MERGE_EVENTS", eventStore: o.mutatedRelevantEvents }),
                                                    e.isTouch && s.dispatch({ type: "SELECT_EVENT", eventInstanceId: l.instanceId });
                                                var m = s.buildDatePointApi(h.dateSpan);
                                                (m.draggedEl = e.subjectEl),
                                                    (m.jsEvent = e.origEvent),
                                                    (m.view = h.component),
                                                    s.publiclyTrigger("drop", [m]),
                                                    s.publiclyTrigger("eventReceive", [{ draggedEl: e.subjectEl, event: new t.EventApi(s, d.defs[a.defId], d.instances[l.instanceId]), view: h.component }]);
                                            }
                                        } else r.publiclyTrigger("_noEventDrop");
                                    }
                                    o.cleanup();
                                });
                            var s = o.component,
                                a = (o.dragging = new v(s.el));
                            (a.pointer.selector = r.SELECTOR), (a.touchScrollAllowed = !1), (a.autoScroller.isEnabled = s.opt("dragScroll"));
                            var l = (o.hitDragging = new y(o.dragging, t.interactionSettingsStore));
                            return (
                                (l.useSubjectCenter = n.useEventCenter),
                                l.emitter.on("pointerdown", o.handlePointerDown),
                                l.emitter.on("dragstart", o.handleDragStart),
                                l.emitter.on("hitupdate", o.handleHitUpdate),
                                l.emitter.on("pointerup", o.handlePointerUp),
                                l.emitter.on("dragend", o.handleDragEnd),
                                o
                            );
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                this.dragging.destroy();
                            }),
                            (r.prototype.displayDrag = function (e, r) {
                                var n = this.component.calendar,
                                    i = this.receivingCalendar;
                                i &&
                                    i !== e &&
                                    (i === n
                                        ? i.dispatch({ type: "SET_EVENT_DRAG", state: { affectedEvents: r.affectedEvents, mutatedEvents: t.createEmptyEventStore(), isEvent: !0, origSeg: r.origSeg } })
                                        : i.dispatch({ type: "UNSET_EVENT_DRAG" })),
                                    e && e.dispatch({ type: "SET_EVENT_DRAG", state: r });
                            }),
                            (r.prototype.clearDrag = function () {
                                var e = this.component.calendar,
                                    t = this.receivingCalendar;
                                t && t.dispatch({ type: "UNSET_EVENT_DRAG" }), e !== t && e.dispatch({ type: "UNSET_EVENT_DRAG" });
                            }),
                            (r.prototype.cleanup = function () {
                                (this.subjectSeg = null), (this.isDragging = !1), (this.eventRange = null), (this.relevantEvents = null), (this.receivingCalendar = null), (this.validMutation = null), (this.mutatedRelevantEvents = null);
                            }),
                            (r.SELECTOR = ".fc-draggable, .fc-resizable"),
                            r
                        );
                    })(t.Interaction),
                    w = (function (e) {
                        function r(r) {
                            var n = e.call(this, r) || this;
                            (n.draggingSeg = null),
                                (n.eventRange = null),
                                (n.relevantEvents = null),
                                (n.validMutation = null),
                                (n.mutatedRelevantEvents = null),
                                (n.handlePointerDown = function (e) {
                                    var t = n.component,
                                        r = n.querySeg(e),
                                        i = (n.eventRange = r.eventRange);
                                    (n.dragging.minDistance = t.opt("eventDragMinDistance")),
                                        n.dragging.setIgnoreMove(!n.component.isValidSegDownEl(e.origEvent.target) || (e.isTouch && n.component.props.eventSelection !== i.instance.instanceId));
                                }),
                                (n.handleDragStart = function (e) {
                                    var r = n.component.calendar,
                                        i = n.eventRange;
                                    (n.relevantEvents = t.getRelevantEvents(r.state.eventStore, n.eventRange.instance.instanceId)),
                                        (n.draggingSeg = n.querySeg(e)),
                                        r.unselect(),
                                        r.publiclyTrigger("eventResizeStart", [{ el: n.draggingSeg.el, event: new t.EventApi(r, i.def, i.instance), jsEvent: e.origEvent, view: n.component.view }]);
                                }),
                                (n.handleHitUpdate = function (e, r, o) {
                                    var s = n.component.calendar,
                                        a = n.relevantEvents,
                                        l = n.hitDragging.initialHit,
                                        c = n.eventRange.instance,
                                        u = null,
                                        d = null,
                                        h = !1,
                                        p = { affectedEvents: a, mutatedEvents: t.createEmptyEventStore(), isEvent: !0, origSeg: n.draggingSeg };
                                    e &&
                                        (u = (function (e, r, n, o, s) {
                                            for (var a = e.component.dateEnv, l = e.dateSpan.range.start, c = r.dateSpan.range.start, u = t.diffDates(l, c, a, e.component.largeUnit), d = {}, h = 0, p = s; h < p.length; h++) {
                                                var f = p[h],
                                                    g = f(e, r);
                                                if (!1 === g) return null;
                                                g && i(d, g);
                                            }
                                            if (n) {
                                                if (a.add(o.start, u) < o.end) return (d.startDelta = u), d;
                                            } else if (a.add(o.end, u) > o.start) return (d.endDelta = u), d;
                                            return null;
                                        })(l, e, o.subjectEl.classList.contains("fc-start-resizer"), c.range, s.pluginSystem.hooks.eventResizeJoinTransforms)),
                                        u && ((d = t.applyMutationToEventStore(a, s.eventUiBases, u, s)), (p.mutatedEvents = d), n.component.isInteractionValid(p) || ((h = !0), (u = null), (d = null), (p.mutatedEvents = null))),
                                        d ? s.dispatch({ type: "SET_EVENT_RESIZE", state: p }) : s.dispatch({ type: "UNSET_EVENT_RESIZE" }),
                                        h ? t.disableCursor() : t.enableCursor(),
                                        r || (u && S(l, e) && (u = null), (n.validMutation = u), (n.mutatedRelevantEvents = d));
                                }),
                                (n.handleDragEnd = function (e) {
                                    var r = n.component.calendar,
                                        i = n.component.view,
                                        o = n.eventRange.def,
                                        s = n.eventRange.instance,
                                        a = new t.EventApi(r, o, s),
                                        l = n.relevantEvents,
                                        c = n.mutatedRelevantEvents;
                                    r.publiclyTrigger("eventResizeStop", [{ el: n.draggingSeg.el, event: a, jsEvent: e.origEvent, view: i }]),
                                        n.validMutation
                                            ? (r.dispatch({ type: "MERGE_EVENTS", eventStore: c }),
                                              r.publiclyTrigger("eventResize", [
                                                  {
                                                      el: n.draggingSeg.el,
                                                      startDelta: n.validMutation.startDelta || t.createDuration(0),
                                                      endDelta: n.validMutation.endDelta || t.createDuration(0),
                                                      prevEvent: a,
                                                      event: new t.EventApi(r, c.defs[o.defId], s ? c.instances[s.instanceId] : null),
                                                      revert: function () {
                                                          r.dispatch({ type: "MERGE_EVENTS", eventStore: l });
                                                      },
                                                      jsEvent: e.origEvent,
                                                      view: i,
                                                  },
                                              ]))
                                            : r.publiclyTrigger("_noEventResize"),
                                        (n.draggingSeg = null),
                                        (n.relevantEvents = null),
                                        (n.validMutation = null);
                                });
                            var o = r.component,
                                s = (n.dragging = new v(o.el));
                            (s.pointer.selector = ".fc-resizer"), (s.touchScrollAllowed = !1), (s.autoScroller.isEnabled = o.opt("dragScroll"));
                            var a = (n.hitDragging = new y(n.dragging, t.interactionSettingsToStore(r)));
                            return a.emitter.on("pointerdown", n.handlePointerDown), a.emitter.on("dragstart", n.handleDragStart), a.emitter.on("hitupdate", n.handleHitUpdate), a.emitter.on("dragend", n.handleDragEnd), n;
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                this.dragging.destroy();
                            }),
                            (r.prototype.querySeg = function (e) {
                                return t.getElSeg(t.elementClosest(e.subjectEl, this.component.fgSegSelector));
                            }),
                            r
                        );
                    })(t.Interaction),
                    T = (function () {
                        function e(e) {
                            var r = this;
                            (this.isRecentPointerDateSelect = !1),
                                (this.onSelect = function (e) {
                                    e.jsEvent && (r.isRecentPointerDateSelect = !0);
                                }),
                                (this.onDocumentPointerUp = function (e) {
                                    var n = r,
                                        i = n.calendar,
                                        o = n.documentPointer,
                                        s = i.state;
                                    if (!o.wasTouchScroll) {
                                        if (s.dateSelection && !r.isRecentPointerDateSelect) {
                                            var a = i.viewOpt("unselectAuto"),
                                                l = i.viewOpt("unselectCancel");
                                            !a || (a && t.elementClosest(o.downEl, l)) || i.unselect(e);
                                        }
                                        s.eventSelection && !t.elementClosest(o.downEl, D.SELECTOR) && i.dispatch({ type: "UNSELECT_EVENT" });
                                    }
                                    r.isRecentPointerDateSelect = !1;
                                }),
                                (this.calendar = e);
                            var n = (this.documentPointer = new l(document));
                            (n.shouldIgnoreMove = !0), (n.shouldWatchScroll = !1), n.emitter.on("pointerup", this.onDocumentPointerUp), e.on("select", this.onSelect);
                        }
                        return (
                            (e.prototype.destroy = function () {
                                this.calendar.off("select", this.onSelect), this.documentPointer.destroy();
                            }),
                            e
                        );
                    })(),
                    C = (function () {
                        function e(e, r) {
                            var n = this;
                            (this.receivingCalendar = null),
                                (this.droppableEvent = null),
                                (this.suppliedDragMeta = null),
                                (this.dragMeta = null),
                                (this.handleDragStart = function (e) {
                                    n.dragMeta = n.buildDragMeta(e.subjectEl);
                                }),
                                (this.handleHitUpdate = function (e, r, o) {
                                    var s = n.hitDragging.dragging,
                                        a = null,
                                        l = null,
                                        c = !1,
                                        u = { affectedEvents: t.createEmptyEventStore(), mutatedEvents: t.createEmptyEventStore(), isEvent: n.dragMeta.create, origSeg: null };
                                    e &&
                                        ((a = e.component.calendar),
                                        n.canDropElOnCalendar(o.subjectEl, a) &&
                                            ((l = (function (e, r, n) {
                                                for (var o = i({}, r.leftoverProps), s = 0, a = n.pluginSystem.hooks.externalDefTransforms; s < a.length; s++) {
                                                    var l = a[s];
                                                    i(o, l(e, r));
                                                }
                                                var c = t.parseEventDef(o, r.sourceId, e.allDay, n.opt("forceEventDuration") || Boolean(r.duration), n),
                                                    u = e.range.start;
                                                e.allDay && r.startTime && (u = n.dateEnv.add(u, r.startTime));
                                                var d = r.duration ? n.dateEnv.add(u, r.duration) : n.getDefaultEventEnd(e.allDay, u),
                                                    h = t.createEventInstance(c.defId, { start: u, end: d });
                                                return { def: c, instance: h };
                                            })(e.dateSpan, n.dragMeta, a)),
                                            (u.mutatedEvents = t.eventTupleToStore(l)),
                                            (c = !t.isInteractionValid(u, a)) && ((u.mutatedEvents = t.createEmptyEventStore()), (l = null)))),
                                        n.displayDrag(a, u),
                                        s.setMirrorIsVisible(r || !l || !document.querySelector(".fc-mirror")),
                                        c ? t.disableCursor() : t.enableCursor(),
                                        r || (s.setMirrorNeedsRevert(!l), (n.receivingCalendar = a), (n.droppableEvent = l));
                                }),
                                (this.handleDragEnd = function (e) {
                                    var r = n,
                                        i = r.receivingCalendar,
                                        o = r.droppableEvent;
                                    if ((n.clearDrag(), i && o)) {
                                        var s = n.hitDragging.finalHit,
                                            a = s.component.view,
                                            l = n.dragMeta,
                                            c = i.buildDatePointApi(s.dateSpan);
                                        (c.draggedEl = e.subjectEl),
                                            (c.jsEvent = e.origEvent),
                                            (c.view = a),
                                            i.publiclyTrigger("drop", [c]),
                                            l.create &&
                                                (i.dispatch({ type: "MERGE_EVENTS", eventStore: t.eventTupleToStore(o) }),
                                                e.isTouch && i.dispatch({ type: "SELECT_EVENT", eventInstanceId: o.instance.instanceId }),
                                                i.publiclyTrigger("eventReceive", [{ draggedEl: e.subjectEl, event: new t.EventApi(i, o.def, o.instance), view: a }]));
                                    }
                                    (n.receivingCalendar = null), (n.droppableEvent = null);
                                });
                            var o = (this.hitDragging = new y(e, t.interactionSettingsStore));
                            (o.requireInitial = !1), o.emitter.on("dragstart", this.handleDragStart), o.emitter.on("hitupdate", this.handleHitUpdate), o.emitter.on("dragend", this.handleDragEnd), (this.suppliedDragMeta = r);
                        }
                        return (
                            (e.prototype.buildDragMeta = function (e) {
                                return "object" == typeof this.suppliedDragMeta
                                    ? t.parseDragMeta(this.suppliedDragMeta)
                                    : "function" == typeof this.suppliedDragMeta
                                    ? t.parseDragMeta(this.suppliedDragMeta(e))
                                    : ((r = (function (e, r) {
                                          var n = t.config.dataAttrPrefix,
                                              i = (n ? n + "-" : "") + r;
                                          return e.getAttribute("data-" + i) || "";
                                      })(e, "event")),
                                      (n = r ? JSON.parse(r) : { create: !1 }),
                                      t.parseDragMeta(n));
                                var r, n;
                            }),
                            (e.prototype.displayDrag = function (e, t) {
                                var r = this.receivingCalendar;
                                r && r !== e && r.dispatch({ type: "UNSET_EVENT_DRAG" }), e && e.dispatch({ type: "SET_EVENT_DRAG", state: t });
                            }),
                            (e.prototype.clearDrag = function () {
                                this.receivingCalendar && this.receivingCalendar.dispatch({ type: "UNSET_EVENT_DRAG" });
                            }),
                            (e.prototype.canDropElOnCalendar = function (e, r) {
                                var n = r.opt("dropAccept");
                                return "function" == typeof n ? n(e) : "string" != typeof n || !n || Boolean(t.elementMatches(e, n));
                            }),
                            e
                        );
                    })();
                t.config.dataAttrPrefix = "";
                var R = (function () {
                        function e(e, r) {
                            var n = this;
                            void 0 === r && (r = {}),
                                (this.handlePointerDown = function (e) {
                                    var r = n.dragging,
                                        i = n.settings,
                                        o = i.minDistance,
                                        s = i.longPressDelay;
                                    (r.minDistance = null != o ? o : e.isTouch ? 0 : t.globalDefaults.eventDragMinDistance), (r.delay = e.isTouch ? (null != s ? s : t.globalDefaults.longPressDelay) : 0);
                                }),
                                (this.handleDragStart = function (e) {
                                    e.isTouch && n.dragging.delay && e.subjectEl.classList.contains("fc-event") && n.dragging.mirror.getMirrorEl().classList.add("fc-selected");
                                }),
                                (this.settings = r);
                            var i = (this.dragging = new v(e));
                            (i.touchScrollAllowed = !1),
                                null != r.itemSelector && (i.pointer.selector = r.itemSelector),
                                null != r.appendTo && (i.mirror.parentNode = r.appendTo),
                                i.emitter.on("pointerdown", this.handlePointerDown),
                                i.emitter.on("dragstart", this.handleDragStart),
                                new C(i, r.eventData);
                        }
                        return (
                            (e.prototype.destroy = function () {
                                this.dragging.destroy();
                            }),
                            e
                        );
                    })(),
                    I = (function (e) {
                        function t(t) {
                            var r = e.call(this, t) || this;
                            (r.shouldIgnoreMove = !1),
                                (r.mirrorSelector = ""),
                                (r.currentMirrorEl = null),
                                (r.handlePointerDown = function (e) {
                                    r.emitter.trigger("pointerdown", e), r.shouldIgnoreMove || r.emitter.trigger("dragstart", e);
                                }),
                                (r.handlePointerMove = function (e) {
                                    r.shouldIgnoreMove || r.emitter.trigger("dragmove", e);
                                }),
                                (r.handlePointerUp = function (e) {
                                    r.emitter.trigger("pointerup", e), r.shouldIgnoreMove || r.emitter.trigger("dragend", e);
                                });
                            var n = (r.pointer = new l(t));
                            return n.emitter.on("pointerdown", r.handlePointerDown), n.emitter.on("pointermove", r.handlePointerMove), n.emitter.on("pointerup", r.handlePointerUp), r;
                        }
                        return (
                            n(t, e),
                            (t.prototype.destroy = function () {
                                this.pointer.destroy();
                            }),
                            (t.prototype.setIgnoreMove = function (e) {
                                this.shouldIgnoreMove = e;
                            }),
                            (t.prototype.setMirrorIsVisible = function (e) {
                                if (e) this.currentMirrorEl && ((this.currentMirrorEl.style.visibility = ""), (this.currentMirrorEl = null));
                                else {
                                    var t = this.mirrorSelector ? document.querySelector(this.mirrorSelector) : null;
                                    t && ((this.currentMirrorEl = t), (t.style.visibility = "hidden"));
                                }
                            }),
                            t
                        );
                    })(t.ElementDragging),
                    M = (function () {
                        function e(e, t) {
                            var r = document;
                            e === document || e instanceof Element ? ((r = e), (t = t || {})) : (t = e || {});
                            var n = (this.dragging = new I(r));
                            "string" == typeof t.itemSelector ? (n.pointer.selector = t.itemSelector) : r === document && (n.pointer.selector = "[data-event]"),
                                "string" == typeof t.mirrorSelector && (n.mirrorSelector = t.mirrorSelector),
                                new C(n, t.eventData);
                        }
                        return (
                            (e.prototype.destroy = function () {
                                this.dragging.destroy();
                            }),
                            e
                        );
                    })(),
                    P = t.createPlugin({ componentInteractions: [E, b, D, w], calendarInteractions: [T], elementDraggingImpl: v });
                (e.Draggable = R), (e.FeaturefulElementDragging = v), (e.PointerDragging = l), (e.ThirdPartyDraggable = M), (e.default = P), Object.defineProperty(e, "__esModule", { value: !0 });
            })(t, r(13));
        },
        252: function (e, t, r) {
            /*!
@fullcalendar/list v4.0.1
Docs & License: https://fullcalendar.io/
(c) 2019 Adam Shaw
*/
            !(function (e, t) {
                "use strict";
                /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */ var r = function (
                    e,
                    t
                ) {
                    return (r =
                        Object.setPrototypeOf ||
                        ({ __proto__: [] } instanceof Array &&
                            function (e, t) {
                                e.__proto__ = t;
                            }) ||
                        function (e, t) {
                            for (var r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                        })(e, t);
                };
                function n(e, t) {
                    function n() {
                        this.constructor = e;
                    }
                    r(e, t), (e.prototype = null === t ? Object.create(t) : ((n.prototype = t.prototype), new n()));
                }
                var i = (function (e) {
                        function r(t) {
                            var r = e.call(this, t.context) || this;
                            return (r.listView = t), r;
                        }
                        return (
                            n(r, e),
                            (r.prototype.attachSegs = function (e) {
                                e.length ? this.listView.renderSegList(e) : this.listView.renderEmptyMessage();
                            }),
                            (r.prototype.detachSegs = function () {}),
                            (r.prototype.renderSegHtml = function (e) {
                                var r,
                                    n = this.context,
                                    i = n.view,
                                    o = n.theme,
                                    s = e.eventRange,
                                    a = s.def,
                                    l = s.instance,
                                    c = s.ui,
                                    u = a.url,
                                    d = ["fc-list-item"].concat(c.classNames),
                                    h = c.backgroundColor;
                                return (
                                    (r = a.allDay
                                        ? t.getAllDayHtml(i)
                                        : t.isMultiDayRange(s.range)
                                        ? e.isStart
                                            ? t.htmlEscape(this._getTimeText(l.range.start, e.end, !1))
                                            : e.isEnd
                                            ? t.htmlEscape(this._getTimeText(e.start, l.range.end, !1))
                                            : t.getAllDayHtml(i)
                                        : t.htmlEscape(this.getTimeText(s))),
                                    u && d.push("fc-has-url"),
                                    '<tr class="' +
                                        d.join(" ") +
                                        '">' +
                                        (this.displayEventTime ? '<td class="fc-list-item-time ' + o.getClass("widgetContent") + '">' + (r || "") + "</td>" : "") +
                                        '<td class="fc-list-item-marker ' +
                                        o.getClass("widgetContent") +
                                        '"><span class="fc-event-dot"' +
                                        (h ? ' style="background-color:' + h + '"' : "") +
                                        '></span></td><td class="fc-list-item-title ' +
                                        o.getClass("widgetContent") +
                                        '"><a' +
                                        (u ? ' href="' + t.htmlEscape(u) + '"' : "") +
                                        ">" +
                                        t.htmlEscape(a.title || "") +
                                        "</a></td></tr>"
                                );
                            }),
                            (r.prototype.computeEventTimeFormat = function () {
                                return { hour: "numeric", minute: "2-digit", meridiem: "short" };
                            }),
                            r
                        );
                    })(t.FgEventRenderer),
                    o = (function (e) {
                        function r(r, n, o, a) {
                            var l = e.call(this, r, n, o, a) || this;
                            (l.computeDateVars = t.memoize(s)), (l.eventStoreToSegs = t.memoize(l._eventStoreToSegs));
                            var c = (l.eventRenderer = new i(l));
                            (l.renderContent = t.memoizeRendering(c.renderSegs.bind(c), c.unrender.bind(c))), l.el.classList.add("fc-list-view");
                            for (var u = (l.theme.getClass("listView") || "").split(" "), d = 0, h = u; d < h.length; d++) {
                                var p = h[d];
                                p && l.el.classList.add(p);
                            }
                            return (l.scroller = new t.ScrollComponent("hidden", "auto")), l.el.appendChild(l.scroller.el), (l.contentEl = l.scroller.el), r.calendar.registerInteractiveComponent(l, { el: l.el }), l;
                        }
                        return (
                            n(r, e),
                            (r.prototype.render = function (e) {
                                var t = this.computeDateVars(e.dateProfile),
                                    r = t.dayDates,
                                    n = t.dayRanges;
                                (this.dayDates = r), this.renderContent(this.eventStoreToSegs(e.eventStore, e.eventUiBases, n));
                            }),
                            (r.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.scroller.destroy(), this.calendar.unregisterInteractiveComponent(this);
                            }),
                            (r.prototype.updateSize = function (t, r, n) {
                                e.prototype.updateSize.call(this, t, r, n), this.eventRenderer.computeSizes(t), this.eventRenderer.assignSizes(t), this.scroller.clear(), n || this.scroller.setHeight(this.computeScrollerHeight(r));
                            }),
                            (r.prototype.computeScrollerHeight = function (e) {
                                return e - t.subtractInnerElHeight(this.el, this.scroller.el);
                            }),
                            (r.prototype._eventStoreToSegs = function (e, r, n) {
                                return this.eventRangesToSegs(t.sliceEventStore(e, r, this.props.dateProfile.activeRange, this.nextDayThreshold).fg, n);
                            }),
                            (r.prototype.eventRangesToSegs = function (e, t) {
                                for (var r = [], n = 0, i = e; n < i.length; n++) {
                                    var o = i[n];
                                    r.push.apply(r, this.eventRangeToSegs(o, t));
                                }
                                return r;
                            }),
                            (r.prototype.eventRangeToSegs = function (e, r) {
                                var n,
                                    i,
                                    o,
                                    s = this.dateEnv,
                                    a = this.nextDayThreshold,
                                    l = e.range,
                                    c = e.def.allDay,
                                    u = [];
                                for (n = 0; n < r.length; n++)
                                    if (
                                        (i = t.intersectRanges(l, r[n])) &&
                                        ((o = {
                                            component: this,
                                            eventRange: e,
                                            start: i.start,
                                            end: i.end,
                                            isStart: e.isStart && i.start.valueOf() === l.start.valueOf(),
                                            isEnd: e.isEnd && i.end.valueOf() === l.end.valueOf(),
                                            dayIndex: n,
                                        }),
                                        u.push(o),
                                        !o.isEnd && !c && n + 1 < r.length && l.end < s.add(r[n + 1].start, a))
                                    ) {
                                        (o.end = l.end), (o.isEnd = !0);
                                        break;
                                    }
                                return u;
                            }),
                            (r.prototype.renderEmptyMessage = function () {
                                this.contentEl.innerHTML = '<div class="fc-list-empty-wrap2"><div class="fc-list-empty-wrap1"><div class="fc-list-empty">' + t.htmlEscape(this.opt("noEventsMessage")) + "</div></div></div>";
                            }),
                            (r.prototype.renderSegList = function (e) {
                                var r,
                                    n,
                                    i,
                                    o = this.groupSegsByDay(e),
                                    s = t.htmlToElement('<table class="fc-list-table ' + this.calendar.theme.getClass("tableList") + '"><tbody></tbody></table>'),
                                    a = s.querySelector("tbody");
                                for (r = 0; r < o.length; r++) if ((n = o[r])) for (a.appendChild(this.buildDayHeaderRow(this.dayDates[r])), n = this.eventRenderer.sortEventSegs(n), i = 0; i < n.length; i++) a.appendChild(n[i].el);
                                (this.contentEl.innerHTML = ""), this.contentEl.appendChild(s);
                            }),
                            (r.prototype.groupSegsByDay = function (e) {
                                var t,
                                    r,
                                    n = [];
                                for (t = 0; t < e.length; t++) (r = e[t]), (n[r.dayIndex] || (n[r.dayIndex] = [])).push(r);
                                return n;
                            }),
                            (r.prototype.buildDayHeaderRow = function (e) {
                                var r = this.dateEnv,
                                    n = t.createFormatter(this.opt("listDayFormat")),
                                    i = t.createFormatter(this.opt("listDayAltFormat"));
                                return t.createElement(
                                    "tr",
                                    { className: "fc-list-heading", "data-date": r.formatIso(e, { omitTime: !0 }) },
                                    '<td class="' +
                                        (this.calendar.theme.getClass("tableListHeading") || this.calendar.theme.getClass("widgetHeader")) +
                                        '" colspan="3">' +
                                        (n ? t.buildGotoAnchorHtml(this, e, { class: "fc-list-heading-main" }, t.htmlEscape(r.format(e, n))) : "") +
                                        (i ? t.buildGotoAnchorHtml(this, e, { class: "fc-list-heading-alt" }, t.htmlEscape(r.format(e, i))) : "") +
                                        "</td>"
                                );
                            }),
                            r
                        );
                    })(t.View);
                function s(e) {
                    for (var r = t.startOfDay(e.renderRange.start), n = e.renderRange.end, i = [], o = []; r < n; ) i.push(r), o.push({ start: r, end: t.addDays(r, 1) }), (r = t.addDays(r, 1));
                    return { dayDates: i, dayRanges: o };
                }
                o.prototype.fgSegSelector = ".fc-list-item";
                var a = t.createPlugin({
                    views: {
                        list: { class: o, buttonTextKey: "list", listDayFormat: { month: "long", day: "numeric", year: "numeric" } },
                        listDay: { type: "list", duration: { days: 1 }, listDayFormat: { weekday: "long" } },
                        listWeek: { type: "list", duration: { weeks: 1 }, listDayFormat: { weekday: "long" }, listDayAltFormat: { month: "long", day: "numeric", year: "numeric" } },
                        listMonth: { type: "list", duration: { month: 1 }, listDayAltFormat: { weekday: "long" } },
                        listYear: { type: "list", duration: { year: 1 }, listDayAltFormat: { weekday: "long" } },
                    },
                });
                (e.ListView = o), (e.default = a), Object.defineProperty(e, "__esModule", { value: !0 });
            })(t, r(13));
        },
        253: function (e, t, r) {
            /*!
@fullcalendar/timegrid v4.0.1
Docs & License: https://fullcalendar.io/
(c) 2019 Adam Shaw
*/
            !(function (e, t, r) {
                "use strict";
                /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */ var n = function (
                    e,
                    t
                ) {
                    return (n =
                        Object.setPrototypeOf ||
                        ({ __proto__: [] } instanceof Array &&
                            function (e, t) {
                                e.__proto__ = t;
                            }) ||
                        function (e, t) {
                            for (var r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                        })(e, t);
                };
                function i(e, t) {
                    function r() {
                        this.constructor = e;
                    }
                    n(e, t), (e.prototype = null === t ? Object.create(t) : ((r.prototype = t.prototype), new r()));
                }
                var o = function () {
                        return (o =
                            Object.assign ||
                            function (e) {
                                for (var t, r = 1, n = arguments.length; r < n; r++) for (var i in (t = arguments[r])) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
                                return e;
                            }).apply(this, arguments);
                    },
                    s = (function (e) {
                        function r(r) {
                            var n = e.call(this, r.context) || this;
                            return (n.timeGrid = r), (n.fullTimeFormat = t.createFormatter({ hour: "numeric", minute: "2-digit", separator: n.context.options.defaultRangeSeparator })), n;
                        }
                        return (
                            i(r, e),
                            (r.prototype.attachSegs = function (e, t) {
                                for (var r = this.timeGrid.groupSegsByCol(e), n = 0; n < r.length; n++) r[n] = this.sortEventSegs(r[n]);
                                (this.segsByCol = r), this.timeGrid.attachSegsByCol(r, this.timeGrid.fgContainerEls);
                            }),
                            (r.prototype.detachSegs = function (e) {
                                e.forEach(function (e) {
                                    t.removeElement(e.el);
                                }),
                                    (this.segsByCol = null);
                            }),
                            (r.prototype.computeSegSizes = function (e) {
                                var t = this.timeGrid,
                                    r = this.segsByCol,
                                    n = t.colCnt;
                                if ((t.computeSegVerticals(e), r)) for (var i = 0; i < n; i++) this.computeSegHorizontals(r[i]);
                            }),
                            (r.prototype.assignSegSizes = function (e) {
                                var t = this.timeGrid,
                                    r = this.segsByCol,
                                    n = t.colCnt;
                                if ((t.assignSegVerticals(e), r)) for (var i = 0; i < n; i++) this.assignSegCss(r[i]);
                            }),
                            (r.prototype.computeEventTimeFormat = function () {
                                return { hour: "numeric", minute: "2-digit", meridiem: !1 };
                            }),
                            (r.prototype.computeDisplayEventEnd = function () {
                                return !0;
                            }),
                            (r.prototype.renderSegHtml = function (e, r) {
                                var n,
                                    i,
                                    o,
                                    s = e.eventRange,
                                    a = s.def,
                                    l = s.ui,
                                    c = a.allDay,
                                    u = l.startEditable,
                                    d = e.isStart && l.durationEditable && this.context.options.eventResizableFromStart,
                                    h = e.isEnd && l.durationEditable,
                                    p = this.getSegClasses(e, u, d || h, r),
                                    f = t.cssToStr(this.getSkinCss(l));
                                if ((p.unshift("fc-time-grid-event"), t.isMultiDayRange(s.range))) {
                                    if (e.isStart || e.isEnd) {
                                        var g = e.start,
                                            v = e.end;
                                        (n = this._getTimeText(g, v, c)), (i = this._getTimeText(g, v, c, this.fullTimeFormat)), (o = this._getTimeText(g, v, c, null, !1));
                                    }
                                } else (n = this.getTimeText(s)), (i = this.getTimeText(s, this.fullTimeFormat)), (o = this.getTimeText(s, null, !1));
                                return (
                                    '<a class="' +
                                    p.join(" ") +
                                    '"' +
                                    (a.url ? ' href="' + t.htmlEscape(a.url) + '"' : "") +
                                    (f ? ' style="' + f + '"' : "") +
                                    '><div class="fc-content">' +
                                    (n ? '<div class="fc-time" data-start="' + t.htmlEscape(o) + '" data-full="' + t.htmlEscape(i) + '"><span>' + t.htmlEscape(n) + "</span></div>" : "") +
                                    (a.title ? '<div class="fc-title">' + t.htmlEscape(a.title) + "</div>" : "") +
                                    "</div>" +
                                    (h ? '<div class="fc-resizer fc-end-resizer"></div>' : "") +
                                    "</a>"
                                );
                            }),
                            (r.prototype.computeSegHorizontals = function (e) {
                                var t, r, n;
                                if (
                                    ((function (e) {
                                        var t, r, n, i, o;
                                        for (t = 0; t < e.length; t++) for (r = e[t], n = 0; n < r.length; n++) for ((i = r[n]).forwardSegs = [], o = t + 1; o < e.length; o++) l(i, e[o], i.forwardSegs);
                                    })(
                                        (t = (function (e) {
                                            var t,
                                                r,
                                                n,
                                                i = [];
                                            for (t = 0; t < e.length; t++) {
                                                for (r = e[t], n = 0; n < i.length && l(r, i[n]).length; n++);
                                                (r.level = n), (i[n] || (i[n] = [])).push(r);
                                            }
                                            return i;
                                        })(e))
                                    ),
                                    (r = t[0]))
                                ) {
                                    for (n = 0; n < r.length; n++) a(r[n]);
                                    for (n = 0; n < r.length; n++) this.computeSegForwardBack(r[n], 0, 0);
                                }
                            }),
                            (r.prototype.computeSegForwardBack = function (e, t, r) {
                                var n,
                                    i = e.forwardSegs;
                                if (void 0 === e.forwardCoord)
                                    for (
                                        i.length ? (this.sortForwardSegs(i), this.computeSegForwardBack(i[0], t + 1, r), (e.forwardCoord = i[0].backwardCoord)) : (e.forwardCoord = 1),
                                            e.backwardCoord = e.forwardCoord - (e.forwardCoord - r) / (t + 1),
                                            n = 0;
                                        n < i.length;
                                        n++
                                    )
                                        this.computeSegForwardBack(i[n], 0, e.forwardCoord);
                            }),
                            (r.prototype.sortForwardSegs = function (e) {
                                var r = e.map(c),
                                    n = [
                                        { field: "forwardPressure", order: -1 },
                                        { field: "backwardCoord", order: 1 },
                                    ].concat(this.context.view.eventOrderSpecs);
                                return (
                                    r.sort(function (e, r) {
                                        return t.compareByFieldSpecs(e, r, n);
                                    }),
                                    r.map(function (e) {
                                        return e._seg;
                                    })
                                );
                            }),
                            (r.prototype.assignSegCss = function (e) {
                                for (var r = 0, n = e; r < n.length; r++) {
                                    var i = n[r];
                                    t.applyStyle(i.el, this.generateSegCss(i)), i.level > 0 && i.el.classList.add("fc-time-grid-event-inset"), i.eventRange.def.title && i.bottom - i.top < 30 && i.el.classList.add("fc-short");
                                }
                            }),
                            (r.prototype.generateSegCss = function (e) {
                                var t,
                                    r,
                                    n = this.context.options.slotEventOverlap,
                                    i = e.backwardCoord,
                                    o = e.forwardCoord,
                                    s = this.timeGrid.generateSegVerticalCss(e),
                                    a = this.timeGrid.isRtl;
                                return (
                                    n && (o = Math.min(1, i + 2 * (o - i))),
                                    a ? ((t = 1 - o), (r = i)) : ((t = i), (r = 1 - o)),
                                    (s.zIndex = e.level + 1),
                                    (s.left = 100 * t + "%"),
                                    (s.right = 100 * r + "%"),
                                    n && e.forwardPressure && (s[a ? "marginLeft" : "marginRight"] = 20),
                                    s
                                );
                            }),
                            r
                        );
                    })(t.FgEventRenderer);
                function a(e) {
                    var t,
                        r,
                        n = e.forwardSegs,
                        i = 0;
                    if (void 0 === e.forwardPressure) {
                        for (t = 0; t < n.length; t++) a((r = n[t])), (i = Math.max(i, 1 + r.forwardPressure));
                        e.forwardPressure = i;
                    }
                }
                function l(e, t, r) {
                    void 0 === r && (r = []);
                    for (var n = 0; n < t.length; n++) (i = e), (o = t[n]), i.bottom > o.top && i.top < o.bottom && r.push(t[n]);
                    var i, o;
                    return r;
                }
                function c(e) {
                    var r = t.buildSegCompareObj(e);
                    return (r.forwardPressure = e.forwardPressure), (r.backwardCoord = e.backwardCoord), r;
                }
                var u = (function (e) {
                        function t() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            i(t, e),
                            (t.prototype.attachSegs = function (e, t) {
                                (this.segsByCol = this.timeGrid.groupSegsByCol(e)), this.timeGrid.attachSegsByCol(this.segsByCol, this.timeGrid.mirrorContainerEls), (this.sourceSeg = t.sourceSeg);
                            }),
                            (t.prototype.generateSegCss = function (t) {
                                var r = e.prototype.generateSegCss.call(this, t),
                                    n = this.sourceSeg;
                                if (n && n.col === t.col) {
                                    var i = e.prototype.generateSegCss.call(this, n);
                                    (r.left = i.left), (r.right = i.right), (r.marginLeft = i.marginLeft), (r.marginRight = i.marginRight);
                                }
                                return r;
                            }),
                            t
                        );
                    })(s),
                    d = (function (e) {
                        function t(t) {
                            var r = e.call(this, t.context) || this;
                            return (r.timeGrid = t), r;
                        }
                        return (
                            i(t, e),
                            (t.prototype.attachSegs = function (e, t) {
                                var r,
                                    n = this.timeGrid;
                                return (
                                    "bgEvent" === e ? (r = n.bgContainerEls) : "businessHours" === e ? (r = n.businessContainerEls) : "highlight" === e && (r = n.highlightContainerEls),
                                    n.attachSegsByCol(n.groupSegsByCol(t), r),
                                    t.map(function (e) {
                                        return e.el;
                                    })
                                );
                            }),
                            (t.prototype.computeSegSizes = function (e) {
                                this.timeGrid.computeSegVerticals(e);
                            }),
                            (t.prototype.assignSegSizes = function (e) {
                                this.timeGrid.assignSegVerticals(e);
                            }),
                            t
                        );
                    })(t.FillRenderer),
                    h = [{ hours: 1 }, { minutes: 30 }, { minutes: 15 }, { seconds: 30 }, { seconds: 15 }],
                    p = (function (e) {
                        function n(r, n, i) {
                            var o = e.call(this, r, n) || this;
                            (o.isSlatSizesDirty = !1), (o.isColSizesDirty = !1), (o.renderSlats = t.memoizeRendering(o._renderSlats));
                            var a = (o.eventRenderer = new s(o)),
                                l = (o.fillRenderer = new d(o));
                            o.mirrorRenderer = new u(o);
                            var c = (o.renderColumns = t.memoizeRendering(o._renderColumns, o._unrenderColumns));
                            return (
                                (o.renderBusinessHours = t.memoizeRendering(l.renderSegs.bind(l, "businessHours"), l.unrender.bind(l, "businessHours"), [c])),
                                (o.renderDateSelection = t.memoizeRendering(o._renderDateSelection, o._unrenderDateSelection, [c])),
                                (o.renderFgEvents = t.memoizeRendering(a.renderSegs.bind(a), a.unrender.bind(a), [c])),
                                (o.renderBgEvents = t.memoizeRendering(l.renderSegs.bind(l, "bgEvent"), l.unrender.bind(l, "bgEvent"), [c])),
                                (o.renderEventSelection = t.memoizeRendering(a.selectByInstanceId.bind(a), a.unselectByInstanceId.bind(a), [o.renderFgEvents])),
                                (o.renderEventDrag = t.memoizeRendering(o._renderEventDrag, o._unrenderEventDrag, [c])),
                                (o.renderEventResize = t.memoizeRendering(o._renderEventResize, o._unrenderEventResize, [c])),
                                o.processOptions(),
                                (n.innerHTML = '<div class="fc-bg"></div><div class="fc-slats"></div><hr class="fc-divider ' + o.theme.getClass("widgetHeader") + '" style="display:none" />'),
                                (o.rootBgContainerEl = n.querySelector(".fc-bg")),
                                (o.slatContainerEl = n.querySelector(".fc-slats")),
                                (o.bottomRuleEl = n.querySelector(".fc-divider")),
                                (o.renderProps = i),
                                o
                            );
                        }
                        return (
                            i(n, e),
                            (n.prototype.processOptions = function () {
                                var e,
                                    r,
                                    n = this.opt("slotDuration"),
                                    i = this.opt("snapDuration");
                                (n = t.createDuration(n)),
                                    (i = i ? t.createDuration(i) : n),
                                    null === (e = t.wholeDivideDurations(n, i)) && ((i = n), (e = 1)),
                                    (this.slotDuration = n),
                                    (this.snapDuration = i),
                                    (this.snapsPerSlot = e),
                                    (r = this.opt("slotLabelFormat")),
                                    Array.isArray(r) && (r = r[r.length - 1]),
                                    (this.labelFormat = t.createFormatter(r || { hour: "numeric", minute: "2-digit", omitZeroMinute: !0, meridiem: "short" })),
                                    (r = this.opt("slotLabelInterval")),
                                    (this.labelInterval = r ? t.createDuration(r) : this.computeLabelInterval(n));
                            }),
                            (n.prototype.computeLabelInterval = function (e) {
                                var r, n, i;
                                for (r = h.length - 1; r >= 0; r--) if (((n = t.createDuration(h[r])), null !== (i = t.wholeDivideDurations(n, e)) && i > 1)) return n;
                                return e;
                            }),
                            (n.prototype.render = function (e) {
                                var t = e.cells;
                                (this.colCnt = t.length),
                                    this.renderSlats(e.dateProfile),
                                    this.renderColumns(e.cells, e.dateProfile),
                                    this.renderBusinessHours(e.businessHourSegs),
                                    this.renderDateSelection(e.dateSelectionSegs),
                                    this.renderFgEvents(e.fgEventSegs),
                                    this.renderBgEvents(e.bgEventSegs),
                                    this.renderEventSelection(e.eventSelection),
                                    this.renderEventDrag(e.eventDrag),
                                    this.renderEventResize(e.eventResize);
                            }),
                            (n.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.renderSlats.unrender(), this.renderColumns.unrender();
                            }),
                            (n.prototype.updateSize = function (e) {
                                var t = this.fillRenderer,
                                    r = this.eventRenderer,
                                    n = this.mirrorRenderer;
                                (e || this.isSlatSizesDirty) && (this.buildSlatPositions(), (this.isSlatSizesDirty = !1)),
                                    (e || this.isColSizesDirty) && (this.buildColPositions(), (this.isColSizesDirty = !1)),
                                    t.computeSizes(e),
                                    r.computeSizes(e),
                                    n.computeSizes(e),
                                    t.assignSizes(e),
                                    r.assignSizes(e),
                                    n.assignSizes(e);
                            }),
                            (n.prototype._renderSlats = function (e) {
                                var r = this.theme;
                                (this.slatContainerEl.innerHTML = '<table class="' + r.getClass("tableGrid") + '">' + this.renderSlatRowHtml(e) + "</table>"),
                                    (this.slatEls = t.findElements(this.slatContainerEl, "tr")),
                                    (this.slatPositions = new t.PositionCache(this.el, this.slatEls, !1, !0)),
                                    (this.isSlatSizesDirty = !0);
                            }),
                            (n.prototype.renderSlatRowHtml = function (e) {
                                for (var r, n, i, o = this.dateEnv, s = this.theme, a = this.isRtl, l = "", c = t.startOfDay(e.renderRange.start), u = e.minTime, d = t.createDuration(0); t.asRoughMs(u) < t.asRoughMs(e.maxTime); )
                                    (r = o.add(c, u)),
                                        (n = null !== t.wholeDivideDurations(d, this.labelInterval)),
                                        (i = '<td class="fc-axis fc-time ' + s.getClass("widgetContent") + '">' + (n ? "<span>" + t.htmlEscape(o.format(r, this.labelFormat)) + "</span>" : "") + "</td>"),
                                        (l += '<tr data-time="' + t.formatIsoTimeString(r) + '"' + (n ? "" : ' class="fc-minor"') + ">" + (a ? "" : i) + '<td class="' + s.getClass("widgetContent") + '"></td>' + (a ? i : "") + "</tr>"),
                                        (u = t.addDurations(u, this.slotDuration)),
                                        (d = t.addDurations(d, this.slotDuration));
                                return l;
                            }),
                            (n.prototype._renderColumns = function (e, n) {
                                var i = this.theme,
                                    o = new r.DayBgRow(this.context);
                                (this.rootBgContainerEl.innerHTML = '<table class="' + i.getClass("tableGrid") + '">' + o.renderHtml({ cells: e, dateProfile: n, renderIntroHtml: this.renderProps.renderBgIntroHtml }) + "</table>"),
                                    (this.colEls = t.findElements(this.el, ".fc-day, .fc-disabled-day")),
                                    this.isRtl && this.colEls.reverse(),
                                    (this.colPositions = new t.PositionCache(this.el, this.colEls, !0, !1)),
                                    this.renderContentSkeleton(),
                                    (this.isColSizesDirty = !0);
                            }),
                            (n.prototype._unrenderColumns = function () {
                                this.unrenderContentSkeleton();
                            }),
                            (n.prototype.renderContentSkeleton = function () {
                                var e,
                                    r = [];
                                r.push(this.renderProps.renderIntroHtml());
                                for (var n = 0; n < this.colCnt; n++)
                                    r.push(
                                        '<td><div class="fc-content-col"><div class="fc-event-container fc-mirror-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td>'
                                    );
                                this.isRtl && r.reverse(),
                                    (e = this.contentSkeletonEl = t.htmlToElement('<div class="fc-content-skeleton"><table><tr>' + r.join("") + "</tr></table></div>")),
                                    (this.colContainerEls = t.findElements(e, ".fc-content-col")),
                                    (this.mirrorContainerEls = t.findElements(e, ".fc-mirror-container")),
                                    (this.fgContainerEls = t.findElements(e, ".fc-event-container:not(.fc-mirror-container)")),
                                    (this.bgContainerEls = t.findElements(e, ".fc-bgevent-container")),
                                    (this.highlightContainerEls = t.findElements(e, ".fc-highlight-container")),
                                    (this.businessContainerEls = t.findElements(e, ".fc-business-container")),
                                    this.isRtl &&
                                        (this.colContainerEls.reverse(),
                                        this.mirrorContainerEls.reverse(),
                                        this.fgContainerEls.reverse(),
                                        this.bgContainerEls.reverse(),
                                        this.highlightContainerEls.reverse(),
                                        this.businessContainerEls.reverse()),
                                    this.el.appendChild(e);
                            }),
                            (n.prototype.unrenderContentSkeleton = function () {
                                t.removeElement(this.contentSkeletonEl);
                            }),
                            (n.prototype.groupSegsByCol = function (e) {
                                var t,
                                    r = [];
                                for (t = 0; t < this.colCnt; t++) r.push([]);
                                for (t = 0; t < e.length; t++) r[e[t].col].push(e[t]);
                                return r;
                            }),
                            (n.prototype.attachSegsByCol = function (e, t) {
                                var r, n, i;
                                for (r = 0; r < this.colCnt; r++) for (n = e[r], i = 0; i < n.length; i++) t[r].appendChild(n[i].el);
                            }),
                            (n.prototype.getNowIndicatorUnit = function () {
                                return "minute";
                            }),
                            (n.prototype.renderNowIndicator = function (e, r) {
                                if (this.colContainerEls) {
                                    var n,
                                        i = this.computeDateTop(r),
                                        o = [];
                                    for (n = 0; n < e.length; n++) {
                                        var s = t.createElement("div", { className: "fc-now-indicator fc-now-indicator-line" });
                                        (s.style.top = i + "px"), this.colContainerEls[e[n].col].appendChild(s), o.push(s);
                                    }
                                    if (e.length > 0) {
                                        var a = t.createElement("div", { className: "fc-now-indicator fc-now-indicator-arrow" });
                                        (a.style.top = i + "px"), this.contentSkeletonEl.appendChild(a), o.push(a);
                                    }
                                    this.nowIndicatorEls = o;
                                }
                            }),
                            (n.prototype.unrenderNowIndicator = function () {
                                this.nowIndicatorEls && (this.nowIndicatorEls.forEach(t.removeElement), (this.nowIndicatorEls = null));
                            }),
                            (n.prototype.getTotalSlatHeight = function () {
                                return this.slatContainerEl.offsetHeight;
                            }),
                            (n.prototype.computeDateTop = function (e, r) {
                                return r || (r = t.startOfDay(e)), this.computeTimeTop(e.valueOf() - r.valueOf());
                            }),
                            (n.prototype.computeTimeTop = function (e) {
                                var r,
                                    n,
                                    i = this.slatEls.length,
                                    o = this.props.dateProfile,
                                    s = (e - t.asRoughMs(o.minTime)) / t.asRoughMs(this.slotDuration);
                                return (s = Math.max(0, s)), (s = Math.min(i, s)), (r = Math.floor(s)), (r = Math.min(r, i - 1)), (n = s - r), this.slatPositions.tops[r] + this.slatPositions.getHeight(r) * n;
                            }),
                            (n.prototype.computeSegVerticals = function (e) {
                                var t,
                                    r,
                                    n,
                                    i = this.opt("timeGridEventMinHeight");
                                for (t = 0; t < e.length; t++) (r = e[t]), (n = this.props.cells[r.col].date), (r.top = this.computeDateTop(r.start, n)), (r.bottom = Math.max(r.top + i, this.computeDateTop(r.end, n)));
                            }),
                            (n.prototype.assignSegVerticals = function (e) {
                                var r, n;
                                for (r = 0; r < e.length; r++) (n = e[r]), t.applyStyle(n.el, this.generateSegVerticalCss(n));
                            }),
                            (n.prototype.generateSegVerticalCss = function (e) {
                                return { top: e.top, bottom: -e.bottom };
                            }),
                            (n.prototype.buildColPositions = function () {
                                this.colPositions.build();
                            }),
                            (n.prototype.buildSlatPositions = function () {
                                this.slatPositions.build();
                            }),
                            (n.prototype.positionToHit = function (e, r) {
                                var n = this.dateEnv,
                                    i = this.snapsPerSlot,
                                    o = this.slatPositions,
                                    s = this.colPositions,
                                    a = s.leftToIndex(e),
                                    l = o.topToIndex(r);
                                if (null != a && null != l) {
                                    var c = o.tops[l],
                                        u = o.getHeight(l),
                                        d = (r - c) / u,
                                        h = Math.floor(d * i),
                                        p = l * i + h,
                                        f = this.props.cells[a].date,
                                        g = t.addDurations(this.props.dateProfile.minTime, t.multiplyDuration(this.snapDuration, p)),
                                        v = n.add(f, g),
                                        m = n.add(v, this.snapDuration);
                                    return { col: a, dateSpan: { range: { start: v, end: m }, allDay: !1 }, dayEl: this.colEls[a], relativeRect: { left: s.lefts[a], right: s.rights[a], top: c, bottom: c + u } };
                                }
                            }),
                            (n.prototype._renderEventDrag = function (e) {
                                e && (this.eventRenderer.hideByHash(e.affectedInstances), e.isEvent ? this.mirrorRenderer.renderSegs(e.segs, { isDragging: !0, sourceSeg: e.sourceSeg }) : this.fillRenderer.renderSegs("highlight", e.segs));
                            }),
                            (n.prototype._unrenderEventDrag = function (e) {
                                e && (this.eventRenderer.showByHash(e.affectedInstances), this.mirrorRenderer.unrender(e.segs, { isDragging: !0, sourceSeg: e.sourceSeg }), this.fillRenderer.unrender("highlight"));
                            }),
                            (n.prototype._renderEventResize = function (e) {
                                e && (this.eventRenderer.hideByHash(e.affectedInstances), this.mirrorRenderer.renderSegs(e.segs, { isResizing: !0, sourceSeg: e.sourceSeg }));
                            }),
                            (n.prototype._unrenderEventResize = function (e) {
                                e && (this.eventRenderer.showByHash(e.affectedInstances), this.mirrorRenderer.unrender(e.segs, { isResizing: !0, sourceSeg: e.sourceSeg }));
                            }),
                            (n.prototype._renderDateSelection = function (e) {
                                e && (this.opt("selectMirror") ? this.mirrorRenderer.renderSegs(e, { isSelecting: !0 }) : this.fillRenderer.renderSegs("highlight", e));
                            }),
                            (n.prototype._unrenderDateSelection = function (e) {
                                this.mirrorRenderer.unrender(e, { isSelecting: !0 }), this.fillRenderer.unrender("highlight");
                            }),
                            n
                        );
                    })(t.DateComponent),
                    f = (function (e) {
                        function r() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            i(r, e),
                            (r.prototype.getKeyInfo = function () {
                                return { allDay: {}, timed: {} };
                            }),
                            (r.prototype.getKeysForDateSpan = function (e) {
                                return e.allDay ? ["allDay"] : ["timed"];
                            }),
                            (r.prototype.getKeysForEventDef = function (e) {
                                return e.allDay ? (t.hasBgRendering(e) ? ["timed", "allDay"] : ["allDay"]) : ["timed"];
                            }),
                            r
                        );
                    })(t.Splitter),
                    g = t.createFormatter({ week: "short" }),
                    v = (function (e) {
                        function n(n, i, o, s) {
                            var a = e.call(this, n, i, o, s) || this;
                            (a.splitter = new f()),
                                (a.renderHeadIntroHtml = function () {
                                    var e,
                                        r = a,
                                        n = r.theme,
                                        i = r.dateEnv,
                                        o = a.props.dateProfile.renderRange,
                                        s = t.diffDays(o.start, o.end);
                                    return a.opt("weekNumbers")
                                        ? ((e = i.format(o.start, g)),
                                          '<th class="fc-axis fc-week-number ' +
                                              n.getClass("widgetHeader") +
                                              '" ' +
                                              a.axisStyleAttr() +
                                              ">" +
                                              t.buildGotoAnchorHtml(a, { date: o.start, type: "week", forceOff: s > 1 }, t.htmlEscape(e)) +
                                              "</th>")
                                        : '<th class="fc-axis ' + n.getClass("widgetHeader") + '" ' + a.axisStyleAttr() + "></th>";
                                }),
                                (a.renderTimeGridBgIntroHtml = function () {
                                    var e = a.theme;
                                    return '<td class="fc-axis ' + e.getClass("widgetContent") + '" ' + a.axisStyleAttr() + "></td>";
                                }),
                                (a.renderTimeGridIntroHtml = function () {
                                    return '<td class="fc-axis" ' + a.axisStyleAttr() + "></td>";
                                }),
                                (a.renderDayGridBgIntroHtml = function () {
                                    var e = a.theme;
                                    return '<td class="fc-axis ' + e.getClass("widgetContent") + '" ' + a.axisStyleAttr() + "><span>" + t.getAllDayHtml(a) + "</span></td>";
                                }),
                                (a.renderDayGridIntroHtml = function () {
                                    return '<td class="fc-axis" ' + a.axisStyleAttr() + "></td>";
                                }),
                                a.el.classList.add("fc-timeGrid-view"),
                                (a.el.innerHTML = a.renderSkeletonHtml()),
                                (a.scroller = new t.ScrollComponent("hidden", "auto"));
                            var l = a.scroller.el;
                            a.el.querySelector(".fc-body > tr > td").appendChild(l), l.classList.add("fc-time-grid-container");
                            var c = t.createElement("div", { className: "fc-time-grid" });
                            return (
                                l.appendChild(c),
                                (a.timeGrid = new p(a.context, c, { renderBgIntroHtml: a.renderTimeGridBgIntroHtml, renderIntroHtml: a.renderTimeGridIntroHtml })),
                                a.opt("allDaySlot") &&
                                    ((a.dayGrid = new r.DayGrid(a.context, a.el.querySelector(".fc-day-grid"), {
                                        renderNumberIntroHtml: a.renderDayGridIntroHtml,
                                        renderBgIntroHtml: a.renderDayGridBgIntroHtml,
                                        renderIntroHtml: a.renderDayGridIntroHtml,
                                        colWeekNumbersVisible: !1,
                                        cellWeekNumbersVisible: !1,
                                    })),
                                    (a.dayGrid.bottomCoordPadding = a.el.querySelector(".fc-divider").offsetHeight)),
                                a
                            );
                        }
                        return (
                            i(n, e),
                            (n.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.timeGrid.destroy(), this.dayGrid && this.dayGrid.destroy(), this.scroller.destroy();
                            }),
                            (n.prototype.renderSkeletonHtml = function () {
                                var e = this.theme;
                                return (
                                    '<table class="' +
                                    e.getClass("tableGrid") +
                                    '">' +
                                    (this.opt("columnHeader") ? '<thead class="fc-head"><tr><td class="fc-head-container ' + e.getClass("widgetHeader") + '">&nbsp;</td></tr></thead>' : "") +
                                    '<tbody class="fc-body"><tr><td class="' +
                                    e.getClass("widgetContent") +
                                    '">' +
                                    (this.opt("allDaySlot") ? '<div class="fc-day-grid"></div><hr class="fc-divider ' + e.getClass("widgetHeader") + '" />' : "") +
                                    "</td></tr></tbody></table>"
                                );
                            }),
                            (n.prototype.getNowIndicatorUnit = function () {
                                return this.timeGrid.getNowIndicatorUnit();
                            }),
                            (n.prototype.unrenderNowIndicator = function () {
                                this.timeGrid.unrenderNowIndicator();
                            }),
                            (n.prototype.updateSize = function (t, r, n) {
                                e.prototype.updateSize.call(this, t, r, n), this.timeGrid.updateSize(t), this.dayGrid && this.dayGrid.updateSize(t);
                            }),
                            (n.prototype.updateBaseSize = function (e, r, n) {
                                var i,
                                    o,
                                    s,
                                    a = this;
                                if (((this.axisWidth = t.matchCellWidths(t.findElements(this.el, ".fc-axis"))), this.timeGrid.colEls)) {
                                    var l = t.findElements(this.el, ".fc-row").filter(function (e) {
                                        return !a.scroller.el.contains(e);
                                    });
                                    (this.timeGrid.bottomRuleEl.style.display = "none"),
                                        this.scroller.clear(),
                                        l.forEach(t.uncompensateScroll),
                                        this.dayGrid && (this.dayGrid.removeSegPopover(), (i = this.opt("eventLimit")) && "number" != typeof i && (i = 5), i && this.dayGrid.limitRows(i)),
                                        n ||
                                            ((o = this.computeScrollerHeight(r)),
                                            this.scroller.setHeight(o),
                                            ((s = this.scroller.getScrollbarWidths()).left || s.right) &&
                                                (l.forEach(function (e) {
                                                    t.compensateScroll(e, s);
                                                }),
                                                (o = this.computeScrollerHeight(r)),
                                                this.scroller.setHeight(o)),
                                            this.scroller.lockOverflow(s),
                                            this.timeGrid.getTotalSlatHeight() < o && (this.timeGrid.bottomRuleEl.style.display = ""));
                                } else n || ((o = this.computeScrollerHeight(r)), this.scroller.setHeight(o));
                            }),
                            (n.prototype.computeScrollerHeight = function (e) {
                                return e - t.subtractInnerElHeight(this.el, this.scroller.el);
                            }),
                            (n.prototype.computeInitialDateScroll = function () {
                                var e = t.createDuration(this.opt("scrollTime")),
                                    r = this.timeGrid.computeTimeTop(e.milliseconds);
                                return (r = Math.ceil(r)) && r++, { top: r };
                            }),
                            (n.prototype.queryDateScroll = function () {
                                return { top: this.scroller.getScrollTop() };
                            }),
                            (n.prototype.applyDateScroll = function (e) {
                                void 0 !== e.top && this.scroller.setScrollTop(e.top);
                            }),
                            (n.prototype.axisStyleAttr = function () {
                                return null != this.axisWidth ? 'style="width:' + this.axisWidth + 'px"' : "";
                            }),
                            n
                        );
                    })(t.View);
                v.prototype.usesMinMaxTime = !0;
                var m = (function (e) {
                    function r(r, n) {
                        var i = e.call(this, r, n.el) || this;
                        return (i.buildDayRanges = t.memoize(y)), (i.slicer = new S()), (i.timeGrid = n), r.calendar.registerInteractiveComponent(i, { el: i.timeGrid.el }), i;
                    }
                    return (
                        i(r, e),
                        (r.prototype.destroy = function () {
                            e.prototype.destroy.call(this), this.calendar.unregisterInteractiveComponent(this);
                        }),
                        (r.prototype.render = function (e) {
                            var t = e.dateProfile,
                                r = e.dayTable,
                                n = (this.dayRanges = this.buildDayRanges(r, t, this.dateEnv));
                            this.timeGrid.receiveProps(o({}, this.slicer.sliceProps(e, t, null, this.timeGrid, n), { dateProfile: t, cells: r.cells[0] }));
                        }),
                        (r.prototype.renderNowIndicator = function (e) {
                            this.timeGrid.renderNowIndicator(this.slicer.sliceNowDate(e, this.timeGrid, this.dayRanges), e);
                        }),
                        (r.prototype.queryHit = function (e, t) {
                            var r = this.timeGrid.positionToHit(e, t);
                            if (r)
                                return { component: this.timeGrid, dateSpan: r.dateSpan, dayEl: r.dayEl, rect: { left: r.relativeRect.left, right: r.relativeRect.right, top: r.relativeRect.top, bottom: r.relativeRect.bottom }, layer: 0 };
                        }),
                        r
                    );
                })(t.DateComponent);
                function y(e, t, r) {
                    for (var n = [], i = 0, o = e.headerDates; i < o.length; i++) {
                        var s = o[i];
                        n.push({ start: r.add(s, t.minTime), end: r.add(s, t.maxTime) });
                    }
                    return n;
                }
                var S = (function (e) {
                        function r() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            i(r, e),
                            (r.prototype.sliceRange = function (e, r) {
                                for (var n = [], i = 0; i < r.length; i++) {
                                    var o = t.intersectRanges(e, r[i]);
                                    o && n.push({ start: o.start, end: o.end, isStart: o.start.valueOf() === e.start.valueOf(), isEnd: o.end.valueOf() === e.end.valueOf(), col: i });
                                }
                                return n;
                            }),
                            r
                        );
                    })(t.Slicer),
                    E = (function (e) {
                        function n(n, i, o, s) {
                            var a = e.call(this, n, i, o, s) || this;
                            return (
                                (a.buildDayTable = t.memoize(b)),
                                a.opt("columnHeader") && (a.header = new t.DayHeader(a.context, a.el.querySelector(".fc-head-container"))),
                                (a.simpleTimeGrid = new m(a.context, a.timeGrid)),
                                a.dayGrid && (a.simpleDayGrid = new r.SimpleDayGrid(a.context, a.dayGrid)),
                                a
                            );
                        }
                        return (
                            i(n, e),
                            (n.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.header && this.header.destroy(), this.simpleTimeGrid.destroy(), this.simpleDayGrid && this.simpleDayGrid.destroy();
                            }),
                            (n.prototype.render = function (t) {
                                e.prototype.render.call(this, t);
                                var r = this.props.dateProfile,
                                    n = this.buildDayTable(r, this.dateProfileGenerator),
                                    i = this.splitter.splitProps(t);
                                this.header && this.header.receiveProps({ dateProfile: r, dates: n.headerDates, datesRepDistinctDays: !0, renderIntroHtml: this.renderHeadIntroHtml }),
                                    this.simpleTimeGrid.receiveProps(o({}, i.timed, { dateProfile: r, dayTable: n })),
                                    this.simpleDayGrid && this.simpleDayGrid.receiveProps(o({}, i.allDay, { dateProfile: r, dayTable: n, nextDayThreshold: this.nextDayThreshold, isRigid: !1 }));
                            }),
                            (n.prototype.renderNowIndicator = function (e) {
                                this.simpleTimeGrid.renderNowIndicator(e);
                            }),
                            n
                        );
                    })(v);
                function b(e, r) {
                    var n = new t.DaySeries(e.renderRange, r);
                    return new t.DayTable(n, !1);
                }
                var D = t.createPlugin({
                    defaultView: "timeGridWeek",
                    views: { timeGrid: { class: E, allDaySlot: !0, slotDuration: "00:30:00", slotEventOverlap: !0 }, timeGridDay: { type: "timeGrid", duration: { days: 1 } }, timeGridWeek: { type: "timeGrid", duration: { weeks: 1 } } },
                });
                (e.TimeGridView = E), (e.AbstractTimeGridView = v), (e.buildDayTable = b), (e.buildDayRanges = y), (e.TimeGridSlicer = S), (e.default = D), (e.TimeGrid = p), Object.defineProperty(e, "__esModule", { value: !0 });
            })(t, r(13), r(65));
        },
        254: function (e, t, r) {
            /*!
FullCalendar Timeline Plugin v4.0.2
Docs & License: https://fullcalendar.io/scheduler
(c) 2019 Adam Shaw
*/
            !(function (e, t) {
                "use strict";
                /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */ var r = function (
                    e,
                    t
                ) {
                    return (r =
                        Object.setPrototypeOf ||
                        ({ __proto__: [] } instanceof Array &&
                            function (e, t) {
                                e.__proto__ = t;
                            }) ||
                        function (e, t) {
                            for (var r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                        })(e, t);
                };
                function n(e, t) {
                    function n() {
                        this.constructor = e;
                    }
                    r(e, t), (e.prototype = null === t ? Object.create(t) : ((n.prototype = t.prototype), new n()));
                }
                var i,
                    o = function () {
                        return (o =
                            Object.assign ||
                            function (e) {
                                for (var t, r = 1, n = arguments.length; r < n; r++) for (var i in (t = arguments[r])) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
                                return e;
                            }).apply(this, arguments);
                    },
                    s = (function () {
                        function e() {
                            (this.gutters = {}),
                                (this.el = t.htmlToElement('<div class="fc-scroller-canvas"> <div class="fc-content"></div> <div class="fc-bg"></div> </div>')),
                                (this.contentEl = this.el.querySelector(".fc-content")),
                                (this.bgEl = this.el.querySelector(".fc-bg"));
                        }
                        return (
                            (e.prototype.setGutters = function (e) {
                                e ? o(this.gutters, e) : (this.gutters = {}), this.updateSize();
                            }),
                            (e.prototype.setWidth = function (e) {
                                (this.width = e), this.updateSize();
                            }),
                            (e.prototype.setMinWidth = function (e) {
                                (this.minWidth = e), this.updateSize();
                            }),
                            (e.prototype.clearWidth = function () {
                                (this.width = null), (this.minWidth = null), this.updateSize();
                            }),
                            (e.prototype.updateSize = function () {
                                var e = this.gutters,
                                    r = this.el;
                                t.forceClassName(r, "fc-gutter-left", e.left),
                                    t.forceClassName(r, "fc-gutter-right", e.right),
                                    t.forceClassName(r, "fc-gutter-top", e.top),
                                    t.forceClassName(r, "fc-gutter-bottom", e.bottom),
                                    t.applyStyle(r, {
                                        paddingLeft: e.left || "",
                                        paddingRight: e.right || "",
                                        paddingTop: e.top || "",
                                        paddingBottom: e.bottom || "",
                                        width: null != this.width ? this.width + (e.left || 0) + (e.right || 0) : "",
                                        minWidth: null != this.minWidth ? this.minWidth + (e.left || 0) + (e.right || 0) : "",
                                    }),
                                    t.applyStyle(this.bgEl, { left: e.left || "", right: e.right || "", top: e.top || "", bottom: e.bottom || "" });
                            }),
                            e
                        );
                    })(),
                    a = (function (e) {
                        function r(r, n) {
                            var i = e.call(this, r, n) || this;
                            return (
                                (i.reportScroll = function () {
                                    i.isScrolling || i.reportScrollStart(), i.trigger("scroll"), (i.isMoving = !0), i.requestMovingEnd();
                                }),
                                (i.reportScrollStart = function () {
                                    i.isScrolling || ((i.isScrolling = !0), i.trigger("scrollStart", i.isTouching));
                                }),
                                (i.reportTouchStart = function () {
                                    i.isTouching = !0;
                                }),
                                (i.reportTouchEnd = function () {
                                    i.isTouching && ((i.isTouching = !1), i.isTouchScrollEnabled && i.unbindPreventTouchScroll(), i.isMoving || i.reportScrollEnd());
                                }),
                                (i.isScrolling = !1),
                                (i.isTouching = !1),
                                (i.isMoving = !1),
                                (i.isTouchScrollEnabled = !0),
                                (i.requestMovingEnd = t.debounce(i.reportMovingEnd, 500)),
                                (i.canvas = new s()),
                                i.el.appendChild(i.canvas.el),
                                i.applyOverflow(),
                                i.bindHandlers(),
                                i
                            );
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.unbindHandlers();
                            }),
                            (r.prototype.disableTouchScroll = function () {
                                (this.isTouchScrollEnabled = !1), this.bindPreventTouchScroll();
                            }),
                            (r.prototype.enableTouchScroll = function () {
                                (this.isTouchScrollEnabled = !0), this.isTouching || this.unbindPreventTouchScroll();
                            }),
                            (r.prototype.bindPreventTouchScroll = function () {
                                this.preventTouchScrollHandler || this.el.addEventListener("touchmove", (this.preventTouchScrollHandler = t.preventDefault));
                            }),
                            (r.prototype.unbindPreventTouchScroll = function () {
                                this.preventTouchScrollHandler && (this.el.removeEventListener("touchmove", this.preventTouchScrollHandler), (this.preventTouchScrollHandler = null));
                            }),
                            (r.prototype.bindHandlers = function () {
                                this.el.addEventListener("scroll", this.reportScroll), this.el.addEventListener("touchstart", this.reportTouchStart, { passive: !0 }), this.el.addEventListener("touchend", this.reportTouchEnd);
                            }),
                            (r.prototype.unbindHandlers = function () {
                                this.el.removeEventListener("scroll", this.reportScroll), this.el.removeEventListener("touchstart", this.reportTouchStart, { passive: !0 }), this.el.removeEventListener("touchend", this.reportTouchEnd);
                            }),
                            (r.prototype.reportMovingEnd = function () {
                                (this.isMoving = !1), this.isTouching || this.reportScrollEnd();
                            }),
                            (r.prototype.reportScrollEnd = function () {
                                this.isScrolling && (this.trigger("scrollEnd"), (this.isScrolling = !1));
                            }),
                            (r.prototype.getScrollLeft = function () {
                                var e = this.el,
                                    t = window.getComputedStyle(e).direction,
                                    r = e.scrollLeft;
                                if ("rtl" === t)
                                    switch (l()) {
                                        case "positive":
                                            r = r + e.clientWidth - e.scrollWidth;
                                            break;
                                        case "reverse":
                                            r = -r;
                                    }
                                return r;
                            }),
                            (r.prototype.setScrollLeft = function (e) {
                                var t = this.el,
                                    r = window.getComputedStyle(t).direction;
                                if ("rtl" === r)
                                    switch (l()) {
                                        case "positive":
                                            e = e - t.clientWidth + t.scrollWidth;
                                            break;
                                        case "reverse":
                                            e = -e;
                                    }
                                t.scrollLeft = e;
                            }),
                            (r.prototype.getScrollFromLeft = function () {
                                var e = this.el,
                                    t = window.getComputedStyle(e).direction,
                                    r = e.scrollLeft;
                                if ("rtl" === t)
                                    switch (l()) {
                                        case "negative":
                                            r = r - e.clientWidth + e.scrollWidth;
                                            break;
                                        case "reverse":
                                            r = -r - e.clientWidth + e.scrollWidth;
                                    }
                                return r;
                            }),
                            r
                        );
                    })(t.ScrollComponent);
                function l() {
                    return (
                        i ||
                        ((r = t.htmlToElement('<div style=" position: absolute; top: -1000px; width: 1px; height: 1px; overflow: scroll; direction: rtl; font-size: 100px; ">A</div>')),
                        document.body.appendChild(r),
                        r.scrollLeft > 0 ? (e = "positive") : ((r.scrollLeft = 1), (e = r.scrollLeft > 0 ? "reverse" : "negative")),
                        t.removeElement(r),
                        (i = e))
                    );
                    var e, r;
                }
                t.EmitterMixin.mixInto(a);
                var c = (function () {
                        function e(e, r, n) {
                            (this.isHScrollbarsClipped = !1),
                                (this.isVScrollbarsClipped = !1),
                                "clipped-scroll" === e && ((e = "scroll"), (this.isHScrollbarsClipped = !0)),
                                "clipped-scroll" === r && ((r = "scroll"), (this.isVScrollbarsClipped = !0)),
                                (this.enhancedScroll = new a(e, r)),
                                n.appendChild((this.el = t.createElement("div", { className: "fc-scroller-clip" }))),
                                this.el.appendChild(this.enhancedScroll.el);
                        }
                        return (
                            (e.prototype.destroy = function () {
                                t.removeElement(this.el);
                            }),
                            (e.prototype.updateSize = function () {
                                var e = this.enhancedScroll,
                                    r = e.el,
                                    n = t.computeEdges(r),
                                    i = { marginLeft: 0, marginRight: 0, marginTop: 0, marginBottom: 0 };
                                this.isVScrollbarsClipped && ((i.marginLeft = -n.scrollbarLeft), (i.marginRight = -n.scrollbarRight)),
                                    this.isHScrollbarsClipped && (i.marginBottom = -n.scrollbarBottom),
                                    t.applyStyle(r, i),
                                    (!this.isHScrollbarsClipped && "hidden" !== e.overflowX) || (!this.isVScrollbarsClipped && "hidden" !== e.overflowY) || n.scrollbarLeft || n.scrollbarRight || n.scrollbarBottom
                                        ? r.classList.remove("fc-no-scrollbars")
                                        : r.classList.add("fc-no-scrollbars");
                            }),
                            (e.prototype.setHeight = function (e) {
                                this.enhancedScroll.setHeight(e);
                            }),
                            (e.prototype.getScrollbarWidths = function () {
                                var e = this.enhancedScroll.getScrollbarWidths();
                                return this.isVScrollbarsClipped && ((e.left = 0), (e.right = 0)), this.isHScrollbarsClipped && (e.bottom = 0), e;
                            }),
                            e
                        );
                    })(),
                    u = (function () {
                        function e(e, t) {
                            (this.axis = e), (this.scrollers = t);
                            for (var r = 0, n = this.scrollers; r < n.length; r++) {
                                var i = n[r];
                                this.initScroller(i);
                            }
                        }
                        return (
                            (e.prototype.initScroller = function (e) {
                                var t = this,
                                    r = e.enhancedScroll,
                                    n = function () {
                                        t.assignMasterScroller(e);
                                    };
                                "wheel mousewheel DomMouseScroll MozMousePixelScroll".split(" ").forEach(function (e) {
                                    r.el.addEventListener(e, n);
                                }),
                                    r
                                        .on("scrollStart", function () {
                                            t.masterScroller || t.assignMasterScroller(e);
                                        })
                                        .on("scroll", function () {
                                            if (e === t.masterScroller)
                                                for (var n = 0, i = t.scrollers; n < i.length; n++) {
                                                    var o = i[n];
                                                    if (o !== e)
                                                        switch (t.axis) {
                                                            case "horizontal":
                                                                o.enhancedScroll.el.scrollLeft = r.el.scrollLeft;
                                                                break;
                                                            case "vertical":
                                                                o.enhancedScroll.setScrollTop(r.getScrollTop());
                                                        }
                                                }
                                        })
                                        .on("scrollEnd", function () {
                                            e === t.masterScroller && t.unassignMasterScroller();
                                        });
                            }),
                            (e.prototype.assignMasterScroller = function (e) {
                                this.unassignMasterScroller(), (this.masterScroller = e);
                                for (var t = 0, r = this.scrollers; t < r.length; t++) {
                                    var n = r[t];
                                    n !== e && n.enhancedScroll.disableTouchScroll();
                                }
                            }),
                            (e.prototype.unassignMasterScroller = function () {
                                if (this.masterScroller) {
                                    for (var e = 0, t = this.scrollers; e < t.length; e++) {
                                        var r = t[e];
                                        r.enhancedScroll.enableTouchScroll();
                                    }
                                    this.masterScroller = null;
                                }
                            }),
                            (e.prototype.update = function () {
                                for (
                                    var e,
                                        t,
                                        r = this.scrollers.map(function (e) {
                                            return e.getScrollbarWidths();
                                        }),
                                        n = 0,
                                        i = 0,
                                        o = 0,
                                        s = 0,
                                        a = 0,
                                        l = r;
                                    a < l.length;
                                    a++
                                )
                                    (e = l[a]), (n = Math.max(n, e.left)), (i = Math.max(i, e.right)), (o = Math.max(o, e.top)), (s = Math.max(s, e.bottom));
                                for (t = 0; t < this.scrollers.length; t++) {
                                    var c = this.scrollers[t];
                                    (e = r[t]), c.enhancedScroll.canvas.setGutters("horizontal" === this.axis ? { left: n - e.left, right: i - e.right } : { top: o - e.top, bottom: s - e.bottom });
                                }
                            }),
                            e
                        );
                    })(),
                    d = (function () {
                        function e(e, t, r) {
                            (this.headerScroller = new c("clipped-scroll", "hidden", e)), (this.bodyScroller = new c("auto", r, t)), (this.scrollJoiner = new u("horizontal", [this.headerScroller, this.bodyScroller]));
                        }
                        return (
                            (e.prototype.destroy = function () {
                                this.headerScroller.destroy(), this.bodyScroller.destroy();
                            }),
                            (e.prototype.setHeight = function (e, t) {
                                var r;
                                (r = t ? "auto" : e - this.queryHeadHeight()), this.bodyScroller.setHeight(r), this.headerScroller.updateSize(), this.bodyScroller.updateSize(), this.scrollJoiner.update();
                            }),
                            (e.prototype.queryHeadHeight = function () {
                                return this.headerScroller.enhancedScroll.canvas.contentEl.offsetHeight;
                            }),
                            e
                        );
                    })(),
                    h = (function (e) {
                        function r(r, n) {
                            var i = e.call(this, r) || this;
                            return n.appendChild((i.tableEl = t.createElement("table", { className: i.theme.getClass("tableGrid") }))), i;
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                t.removeElement(this.tableEl), e.prototype.destroy.call(this);
                            }),
                            (r.prototype.render = function (e) {
                                this.renderDates(e.tDateProfile);
                            }),
                            (r.prototype.renderDates = function (e) {
                                for (
                                    var r = this.dateEnv,
                                        n = this.theme,
                                        i = e.cellRows,
                                        o = i[i.length - 1],
                                        s = t.asRoughMs(e.labelInterval) > t.asRoughMs(e.slotDuration),
                                        a = t.isSingleDay(e.slotDuration),
                                        l = "<colgroup>",
                                        c = 0,
                                        u = o;
                                    c < u.length;
                                    c++
                                )
                                    u[c], (l += "<col/>");
                                (l += "</colgroup>"), (l += "<tbody>");
                                for (var d = 0, h = i; d < h.length; d++) {
                                    var p = h[d],
                                        f = p === o;
                                    l += "<tr" + (s && f ? ' class="fc-chrono"' : "") + ">";
                                    for (var g = 0, v = p; g < v.length; g++) {
                                        var m = v[g],
                                            y = [n.getClass("widgetHeader")];
                                        m.isWeekStart && y.push("fc-em-cell"),
                                            a && (y = y.concat(t.getDayClasses(m.date, this.props.dateProfile, this.context, !0))),
                                            (l +=
                                                '<th class="' +
                                                y.join(" ") +
                                                '" data-date="' +
                                                r.formatIso(m.date, { omitTime: !e.isTimeScale, omitTimeZoneOffset: !0 }) +
                                                '"' +
                                                (m.colspan > 1 ? ' colspan="' + m.colspan + '"' : "") +
                                                '><div class="fc-cell-content">' +
                                                m.spanHtml +
                                                "</div></th>");
                                    }
                                    l += "</tr>";
                                }
                                (l += "</tbody>"),
                                    (this.tableEl.innerHTML = l),
                                    (this.slatColEls = t.findElements(this.tableEl, "col")),
                                    (this.innerEls = t.findElements(this.tableEl.querySelector("tr:last-child"), "th .fc-cell-text")),
                                    t.findElements(this.tableEl.querySelectorAll("tr:not(:last-child)"), "th .fc-cell-text").forEach(function (e) {
                                        e.classList.add("fc-sticky");
                                    });
                            }),
                            r
                        );
                    })(t.Component),
                    p = (function (e) {
                        function r(r, n) {
                            var i = e.call(this, r) || this;
                            return n.appendChild((i.el = t.createElement("div", { className: "fc-slats" }))), i;
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                t.removeElement(this.el), e.prototype.destroy.call(this);
                            }),
                            (r.prototype.render = function (e) {
                                this.renderDates(e.tDateProfile);
                            }),
                            (r.prototype.renderDates = function (e) {
                                for (var r = this.theme, n = e.slotDates, i = e.isWeekStarts, o = '<table class="' + r.getClass("tableGrid") + '"><colgroup>', s = 0; s < n.length; s++) o += "<col/>";
                                (o += "</colgroup>"), (o += "<tbody><tr>");
                                for (var s = 0; s < n.length; s++) o += this.slatCellHtml(n[s], i[s], e);
                                (o += "</tr></tbody></table>"),
                                    (this.el.innerHTML = o),
                                    (this.slatColEls = t.findElements(this.el, "col")),
                                    (this.slatEls = t.findElements(this.el, "td")),
                                    (this.outerCoordCache = new t.PositionCache(this.el, this.slatEls, !0, !1)),
                                    (this.innerCoordCache = new t.PositionCache(this.el, t.findChildren(this.slatEls, "div"), !0, !1));
                            }),
                            (r.prototype.slatCellHtml = function (e, r, n) {
                                var i,
                                    o = this.theme,
                                    s = this.dateEnv;
                                return (
                                    n.isTimeScale
                                        ? (i = []).push(t.isInt(s.countDurationsBetween(n.normalizedRange.start, e, n.labelInterval)) ? "fc-major" : "fc-minor")
                                        : (i = t.getDayClasses(e, this.props.dateProfile, this.context)).push("fc-day"),
                                    i.unshift(o.getClass("widgetContent")),
                                    r && i.push("fc-em-cell"),
                                    '<td class="' + i.join(" ") + '" data-date="' + s.formatIso(e, { omitTime: !n.isTimeScale, omitTimeZoneOffset: !0 }) + '"><div></div></td>'
                                );
                            }),
                            (r.prototype.updateSize = function () {
                                this.outerCoordCache.build(), this.innerCoordCache.build();
                            }),
                            (r.prototype.positionToHit = function (e) {
                                var r = this.outerCoordCache,
                                    n = this.props.tDateProfile,
                                    i = r.leftToIndex(e);
                                if (null != i) {
                                    var o = r.getWidth(i),
                                        s = this.isRtl ? (r.rights[i] - e) / o : (e - r.lefts[i]) / o,
                                        a = Math.floor(s * n.snapsPerSlot),
                                        l = this.dateEnv.add(n.slotDates[i], t.multiplyDuration(n.snapDuration, a)),
                                        c = this.dateEnv.add(l, n.snapDuration);
                                    return { dateSpan: { range: { start: l, end: c }, allDay: !this.props.tDateProfile.isTimeScale }, dayEl: this.slatColEls[i], left: r.lefts[i], right: r.rights[i] };
                                }
                                return null;
                            }),
                            r
                        );
                    })(t.Component),
                    f = 18,
                    g = 6,
                    v = 200;
                t.config.MAX_TIMELINE_SLOTS = 1e3;
                var m = [
                    { years: 1 },
                    { months: 1 },
                    { days: 1 },
                    { hours: 1 },
                    { minutes: 30 },
                    { minutes: 15 },
                    { minutes: 10 },
                    { minutes: 5 },
                    { minutes: 1 },
                    { seconds: 30 },
                    { seconds: 15 },
                    { seconds: 10 },
                    { seconds: 5 },
                    { seconds: 1 },
                    { milliseconds: 500 },
                    { milliseconds: 100 },
                    { milliseconds: 10 },
                    { milliseconds: 1 },
                ];
                function y(e, r) {
                    var n = r.dateEnv,
                        i = { labelInterval: b(r, "slotLabelInterval"), slotDuration: b(r, "slotDuration") };
                    !(function (e, r, n) {
                        var i = r.currentRange;
                        if (e.labelInterval) {
                            var o = n.countDurationsBetween(i.start, i.end, e.labelInterval);
                            o > t.config.MAX_TIMELINE_SLOTS && (console.warn("slotLabelInterval results in too many cells"), (e.labelInterval = null));
                        }
                        if (e.slotDuration) {
                            var s = n.countDurationsBetween(i.start, i.end, e.slotDuration);
                            s > t.config.MAX_TIMELINE_SLOTS && (console.warn("slotDuration results in too many cells"), (e.slotDuration = null));
                        }
                        if (e.labelInterval && e.slotDuration) {
                            var a = t.wholeDivideDurations(e.labelInterval, e.slotDuration);
                            (null === a || a < 1) && (console.warn("slotLabelInterval must be a multiple of slotDuration"), (e.slotDuration = null));
                        }
                    })(i, e, n),
                        D(i, e, n),
                        (function (e, r, n) {
                            var i = r.currentRange,
                                o = e.slotDuration;
                            if (!o) {
                                for (var s = D(e, r, n), a = 0, l = m; a < l.length; a++) {
                                    var c = l[a],
                                        u = t.createDuration(c),
                                        d = t.wholeDivideDurations(s, u);
                                    if (null !== d && d > 1 && d <= g) {
                                        o = u;
                                        break;
                                    }
                                }
                                if (o) {
                                    var h = n.countDurationsBetween(i.start, i.end, o);
                                    h > v && (o = null);
                                }
                                o || (o = s), (e.slotDuration = o);
                            }
                        })(i, e, n);
                    var o = r.opt("slotLabelFormat"),
                        s = Array.isArray(o)
                            ? o
                            : null != o
                            ? [o]
                            : (function (e, r, n, i) {
                                  var o,
                                      s,
                                      a = e.labelInterval,
                                      l = t.greatestDurationDenominator(a).unit,
                                      c = i.opt("weekNumbers"),
                                      u = (o = s = null);
                                  switch (("week" !== l || c || (l = "day"), l)) {
                                      case "year":
                                          u = { year: "numeric" };
                                          break;
                                      case "month":
                                          w("years", r, n) > 1 && (u = { year: "numeric" }), (o = { month: "short" });
                                          break;
                                      case "week":
                                          w("years", r, n) > 1 && (u = { year: "numeric" }), (o = { week: "narrow" });
                                          break;
                                      case "day":
                                          w("years", r, n) > 1 ? (u = { year: "numeric", month: "long" }) : w("months", r, n) > 1 && (u = { month: "long" }), c && (o = { week: "short" }), (s = { weekday: "narrow", day: "numeric" });
                                          break;
                                      case "hour":
                                          c && (u = { week: "short" }),
                                              w("days", r, n) > 1 && (o = { weekday: "short", day: "numeric", month: "numeric", omitCommas: !0 }),
                                              (s = { hour: "numeric", minute: "2-digit", omitZeroMinute: !0, meridiem: "short" });
                                          break;
                                      case "minute":
                                          t.asRoughMinutes(a) / 60 >= g
                                              ? ((u = { hour: "numeric", meridiem: "short" }),
                                                (o = function (e) {
                                                    return ":" + t.padStart(e.date.minute, 2);
                                                }))
                                              : (u = { hour: "numeric", minute: "numeric", meridiem: "short" });
                                          break;
                                      case "second":
                                          t.asRoughSeconds(a) / 60 >= g
                                              ? ((u = { hour: "numeric", minute: "2-digit", meridiem: "lowercase" }),
                                                (o = function (e) {
                                                    return ":" + t.padStart(e.date.second, 2);
                                                }))
                                              : (u = { hour: "numeric", minute: "2-digit", second: "2-digit", meridiem: "lowercase" });
                                          break;
                                      case "millisecond":
                                          (u = { hour: "numeric", minute: "2-digit", second: "2-digit", meridiem: "lowercase" }),
                                              (o = function (e) {
                                                  return "." + t.padStart(e.millisecond, 3);
                                              });
                                  }
                                  return [].concat(u || [], o || [], s || []);
                              })(i, e, n, r);
                    (i.headerFormats = s.map(function (e) {
                        return t.createFormatter(e);
                    })),
                        (i.isTimeScale = Boolean(i.slotDuration.milliseconds));
                    var a = null;
                    if (!i.isTimeScale) {
                        var l = t.greatestDurationDenominator(i.slotDuration).unit;
                        /year|month|week/.test(l) && (a = l);
                    }
                    (i.largeUnit = a), (i.emphasizeWeeks = t.isSingleDay(i.slotDuration) && w("weeks", e, n) >= 2 && !r.opt("businessHours"));
                    var c,
                        u,
                        d = r.opt("snapDuration");
                    d && ((c = t.createDuration(d)), (u = t.wholeDivideDurations(i.slotDuration, c))), null == u && ((c = i.slotDuration), (u = 1)), (i.snapDuration = c), (i.snapsPerSlot = u);
                    var h = t.asRoughMs(e.maxTime) - t.asRoughMs(e.minTime),
                        p = S(e.renderRange.start, i, n),
                        f = S(e.renderRange.end, i, n);
                    i.isTimeScale && ((p = n.add(p, e.minTime)), (f = n.add(t.addDays(f, -1), e.maxTime))), (i.timeWindowMs = h), (i.normalizedRange = { start: p, end: f });
                    for (var y = [], C = p; C < f; ) E(C, i, e, r) && y.push(C), (C = n.add(C, i.slotDuration));
                    i.slotDates = y;
                    var R = -1,
                        I = 0,
                        M = [],
                        P = [];
                    for (C = p; C < f; ) E(C, i, e, r) ? (R++, M.push(R), P.push(I)) : M.push(R + 0.5), (C = n.add(C, i.snapDuration)), I++;
                    return (
                        (i.snapDiffToIndex = M),
                        (i.snapIndexToDiff = P),
                        (i.snapCnt = R + 1),
                        (i.slotCnt = i.snapCnt / i.snapsPerSlot),
                        (i.isWeekStarts = (function (e, t) {
                            for (var r = e.slotDates, n = e.emphasizeWeeks, i = null, o = [], s = 0, a = r; s < a.length; s++) {
                                var l = a[s],
                                    c = t.computeWeekNumber(l),
                                    u = n && null !== i && i !== c;
                                (i = c), o.push(u);
                            }
                            return o;
                        })(i, n)),
                        (i.cellRows = (function (e, r, n) {
                            for (
                                var i = e.slotDates,
                                    o = e.headerFormats,
                                    s = o.map(function (e) {
                                        return [];
                                    }),
                                    a = o.map(function (e) {
                                        return e.getLargestUnit ? e.getLargestUnit() : null;
                                    }),
                                    l = 0;
                                l < i.length;
                                l++
                            )
                                for (var c = i[l], u = e.isWeekStarts[l], d = 0; d < o.length; d++) {
                                    var h = o[d],
                                        p = s[d],
                                        f = p[p.length - 1],
                                        g = o.length > 1 && d < o.length - 1,
                                        v = null;
                                    if (g) {
                                        var m = r.format(c, h);
                                        f && f.text === m ? (f.colspan += 1) : (v = T(c, m, a[d], n));
                                    } else if (!f || t.isInt(r.countDurationsBetween(e.normalizedRange.start, c, e.labelInterval))) {
                                        var m = r.format(c, h);
                                        v = T(c, m, a[d], n);
                                    } else f.colspan += 1;
                                    v && ((v.weekStart = u), p.push(v));
                                }
                            return s;
                        })(i, n, r)),
                        i
                    );
                }
                function S(e, r, n) {
                    var i = e;
                    return r.isTimeScale || ((i = t.startOfDay(i)), r.largeUnit && (i = n.startOf(i, r.largeUnit))), i;
                }
                function E(e, r, n, i) {
                    if (i.dateProfileGenerator.isHiddenDay(e)) return !1;
                    if (r.isTimeScale) {
                        var o = t.startOfDay(e),
                            s = e.valueOf() - o.valueOf(),
                            a = s - t.asRoughMs(n.minTime);
                        return (a = ((a % 864e5) + 864e5) % 864e5) < r.timeWindowMs;
                    }
                    return !0;
                }
                function b(e, r) {
                    var n = e.opt(r);
                    if (null != n) return t.createDuration(n);
                }
                function D(e, r, n) {
                    var i = r.currentRange,
                        o = e.labelInterval;
                    if (!o) {
                        var s = void 0;
                        if (e.slotDuration) {
                            for (var a = 0, l = m; a < l.length; a++) {
                                s = l[a];
                                var c = t.createDuration(s),
                                    u = t.wholeDivideDurations(c, e.slotDuration);
                                if (null !== u && u <= g) {
                                    o = c;
                                    break;
                                }
                            }
                            o || (o = e.slotDuration);
                        } else
                            for (var d = 0, h = m; d < h.length; d++) {
                                (s = h[d]), (o = t.createDuration(s));
                                var p = n.countDurationsBetween(i.start, i.end, o);
                                if (p >= f) break;
                            }
                        e.labelInterval = o;
                    }
                    return o;
                }
                function w(e, r, n) {
                    var i = r.currentRange,
                        o = null;
                    return (
                        "years" === e
                            ? (o = n.diffWholeYears(i.start, i.end))
                            : "months" === e
                            ? (o = n.diffWholeMonths(i.start, i.end))
                            : "weeks" === e
                            ? (o = n.diffWholeMonths(i.start, i.end))
                            : "days" === e && (o = t.diffWholeDays(i.start, i.end)),
                        o || 0
                    );
                }
                function T(e, r, n, i) {
                    var o = t.buildGotoAnchorHtml(i, { date: e, type: n, forceOff: !n }, { class: "fc-cell-text" }, t.htmlEscape(r));
                    return { text: r, spanHtml: o, date: e, colspan: 1, isWeekStart: !1 };
                }
                var C,
                    R = (function () {
                        function e(e, t) {
                            (this.headParent = e), (this.bodyParent = t);
                        }
                        return (
                            (e.prototype.render = function (e, r) {
                                var n = r ? { right: -e } : { left: e };
                                this.headParent.appendChild((this.arrowEl = t.createElement("div", { className: "fc-now-indicator fc-now-indicator-arrow", style: n }))),
                                    this.bodyParent.appendChild((this.lineEl = t.createElement("div", { className: "fc-now-indicator fc-now-indicator-line", style: n })));
                            }),
                            (e.prototype.unrender = function () {
                                this.arrowEl && t.removeElement(this.arrowEl), this.lineEl && t.removeElement(this.lineEl);
                            }),
                            e
                        );
                    })(),
                    I = -1 !== (C = t.htmlToElement('<div style="position:-webkit-sticky;position:sticky"></div>').style.position).indexOf("sticky") ? C : null,
                    M = /Edge/.test(navigator.userAgent),
                    P = "-webkit-sticky" === I,
                    H = "fc-sticky",
                    k = (function () {
                        function e(e, r, n) {
                            var i = this;
                            (this.usingRelative = null),
                                (this.updateSize = function () {
                                    var e = Array.prototype.slice.call(i.scroller.canvas.el.querySelectorAll("." + H)),
                                        r = i.queryElGeoms(e),
                                        n = i.scroller.el.clientWidth;
                                    if (i.usingRelative) {
                                        var o = i.computeElDestinations(r, n);
                                        !(function (e, r, n) {
                                            e.forEach(function (e, i) {
                                                var o = r[i].naturalBound;
                                                t.applyStyle(e, { position: "relative", left: n[i].left - o.left, top: n[i].top - o.top });
                                            });
                                        })(e, r, o);
                                    } else
                                        !(function (e, r, n) {
                                            e.forEach(function (e, i) {
                                                var o = 0;
                                                "center" === r[i].intendedTextAlign &&
                                                    ((o = (n - r[i].elWidth) / 2), "center" === r[i].computedTextAlign && (e.setAttribute("data-sticky-center", ""), (e.parentNode.style.textAlign = "left"))),
                                                    t.applyStyle(e, { position: I, left: o, right: 0, top: 0 });
                                            });
                                        })(e, r, n);
                                }),
                                (this.scroller = e),
                                (this.usingRelative = !I || (M && r) || ((M || P) && n)),
                                this.usingRelative && e.on("scrollEnd", this.updateSize);
                        }
                        return (
                            (e.prototype.destroy = function () {
                                this.scroller.off("scrollEnd", this.updateSize);
                            }),
                            (e.prototype.queryElGeoms = function (e) {
                                for (var r = this.scroller.canvas.el.getBoundingClientRect(), n = [], i = 0, o = e; i < o.length; i++) {
                                    var s = o[i],
                                        a = t.translateRect(s.parentNode.getBoundingClientRect(), -r.left, -r.top),
                                        l = s.getBoundingClientRect(),
                                        c = window.getComputedStyle(s),
                                        u = window.getComputedStyle(s.parentNode).textAlign,
                                        d = u,
                                        h = null;
                                    "sticky" !== c.position && (h = t.translateRect(l, -r.left - (parseFloat(c.left) || 0), -r.top - (parseFloat(c.top) || 0))),
                                        s.hasAttribute("data-sticky-center") && (d = "center"),
                                        n.push({ parentBound: a, naturalBound: h, elWidth: l.width, elHeight: l.height, computedTextAlign: u, intendedTextAlign: d });
                                }
                                return n;
                            }),
                            (e.prototype.computeElDestinations = function (e, t) {
                                var r = this.scroller.getScrollFromLeft(),
                                    n = this.scroller.getScrollTop(),
                                    i = r + t;
                                return e.map(function (e) {
                                    var t,
                                        o,
                                        s = e.elWidth,
                                        a = e.elHeight,
                                        l = e.parentBound,
                                        c = e.naturalBound;
                                    switch (e.intendedTextAlign) {
                                        case "left":
                                            t = r;
                                            break;
                                        case "right":
                                            t = i - s;
                                            break;
                                        case "center":
                                            t = (r + i) / 2 - s / 2;
                                    }
                                    return (t = Math.min(t, l.right - s)), (t = Math.max(t, l.left)), (o = n), (o = Math.min(o, l.bottom - a)), (o = Math.max(o, c.top)), { left: t, top: o };
                                });
                            }),
                            e
                        );
                    })(),
                    _ = (function (e) {
                        function r(t, r, n) {
                            var i = e.call(this, t) || this,
                                o = (i.layout = new d(r, n, "auto")),
                                s = o.headerScroller.enhancedScroll,
                                a = o.bodyScroller.enhancedScroll;
                            return (
                                (i.headStickyScroller = new k(s, i.isRtl, !1)),
                                (i.bodyStickyScroller = new k(a, i.isRtl, !1)),
                                (i.header = new h(t, s.canvas.contentEl)),
                                (i.slats = new p(t, a.canvas.bgEl)),
                                (i.nowIndicator = new R(s.canvas.el, a.canvas.el)),
                                i
                            );
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                this.layout.destroy(), this.header.destroy(), this.slats.destroy(), this.nowIndicator.unrender(), this.headStickyScroller.destroy(), this.bodyStickyScroller.destroy(), e.prototype.destroy.call(this);
                            }),
                            (r.prototype.render = function (e) {
                                var t = (this.tDateProfile = y(e.dateProfile, this.view));
                                this.header.receiveProps({ dateProfile: e.dateProfile, tDateProfile: t }), this.slats.receiveProps({ dateProfile: e.dateProfile, tDateProfile: t });
                            }),
                            (r.prototype.getNowIndicatorUnit = function (e) {
                                var r = (this.tDateProfile = y(e, this.view));
                                if (r.isTimeScale) return t.greatestDurationDenominator(r.slotDuration).unit;
                            }),
                            (r.prototype.renderNowIndicator = function (e) {
                                t.rangeContainsMarker(this.tDateProfile.normalizedRange, e) && this.nowIndicator.render(this.dateToCoord(e), this.isRtl);
                            }),
                            (r.prototype.unrenderNowIndicator = function () {
                                this.nowIndicator.unrender();
                            }),
                            (r.prototype.updateSize = function (e, t, r) {
                                this.applySlotWidth(this.computeSlotWidth()), this.layout.setHeight(t, r), this.slats.updateSize();
                            }),
                            (r.prototype.updateStickyScrollers = function () {
                                this.headStickyScroller.updateSize(), this.bodyStickyScroller.updateSize();
                            }),
                            (r.prototype.computeSlotWidth = function () {
                                var e = this.opt("slotWidth") || "";
                                return "" === e && (e = this.computeDefaultSlotWidth(this.tDateProfile)), e;
                            }),
                            (r.prototype.computeDefaultSlotWidth = function (e) {
                                var r = 0;
                                this.header.innerEls.forEach(function (e, t) {
                                    r = Math.max(r, e.offsetWidth);
                                });
                                var n = r + 1,
                                    i = t.wholeDivideDurations(e.labelInterval, e.slotDuration),
                                    o = Math.ceil(n / i),
                                    s = window.getComputedStyle(this.header.slatColEls[0]).minWidth;
                                return s && (s = parseInt(s, 10)) && (o = Math.max(o, s)), o;
                            }),
                            (r.prototype.applySlotWidth = function (e) {
                                var t = this.layout,
                                    r = this.tDateProfile,
                                    n = "",
                                    i = "",
                                    o = "";
                                if ("" !== e) {
                                    (e = Math.round(e)), (n = e * r.slotDates.length), (i = ""), (o = e);
                                    var s = t.bodyScroller.enhancedScroll.getClientWidth();
                                    s > n && ((i = s), (n = ""), (o = Math.floor(s / r.slotDates.length)));
                                }
                                t.headerScroller.enhancedScroll.canvas.setWidth(n),
                                    t.headerScroller.enhancedScroll.canvas.setMinWidth(i),
                                    t.bodyScroller.enhancedScroll.canvas.setWidth(n),
                                    t.bodyScroller.enhancedScroll.canvas.setMinWidth(i),
                                    "" !== o &&
                                        this.header.slatColEls
                                            .slice(0, -1)
                                            .concat(this.slats.slatColEls.slice(0, -1))
                                            .forEach(function (e) {
                                                e.style.width = o + "px";
                                            });
                            }),
                            (r.prototype.computeDateSnapCoverage = function (e) {
                                var r = this.dateEnv,
                                    n = this.tDateProfile,
                                    i = r.countDurationsBetween(n.normalizedRange.start, e, n.snapDuration);
                                if (i < 0) return 0;
                                if (i >= n.snapDiffToIndex.length) return n.snapCnt;
                                var o = Math.floor(i),
                                    s = n.snapDiffToIndex[o];
                                return t.isInt(s) ? (s += i - o) : (s = Math.ceil(s)), s;
                            }),
                            (r.prototype.dateToCoord = function (e) {
                                var t = this.tDateProfile,
                                    r = this.computeDateSnapCoverage(e),
                                    n = r / t.snapsPerSlot,
                                    i = Math.floor(n);
                                i = Math.min(i, t.slotCnt - 1);
                                var o = n - i,
                                    s = this.slats,
                                    a = s.innerCoordCache,
                                    l = s.outerCoordCache;
                                return this.isRtl ? l.rights[i] - a.getWidth(i) * o - l.originClientRect.width : l.lefts[i] + a.getWidth(i) * o;
                            }),
                            (r.prototype.rangeToCoords = function (e) {
                                return this.isRtl ? { right: this.dateToCoord(e.start), left: this.dateToCoord(e.end) } : { left: this.dateToCoord(e.start), right: this.dateToCoord(e.end) };
                            }),
                            (r.prototype.computeInitialDateScroll = function () {
                                var e = this.dateEnv,
                                    r = this.props.dateProfile,
                                    n = 0;
                                if (r) {
                                    var i = this.opt("scrollTime");
                                    i && ((i = t.createDuration(i)), (n = this.dateToCoord(e.add(t.startOfDay(r.activeRange.start), i))), !this.isRtl && n && (n += 1));
                                }
                                return { left: n };
                            }),
                            (r.prototype.queryDateScroll = function () {
                                var e = this.layout.bodyScroller.enhancedScroll;
                                return { left: e.getScrollLeft() };
                            }),
                            (r.prototype.applyDateScroll = function (e) {
                                this.layout.bodyScroller.enhancedScroll.setScrollLeft(e.left || 0), this.layout.headerScroller.enhancedScroll.setScrollLeft(e.left || 0);
                            }),
                            r
                        );
                    })(t.Component),
                    x = (function (e) {
                        function r(t, r, n) {
                            var i = e.call(this, t) || this;
                            return (i.masterContainerEl = r), (i.timeAxis = n), i;
                        }
                        return (
                            n(r, e),
                            (r.prototype.renderSegHtml = function (e, r) {
                                var n = e.eventRange,
                                    i = n.def,
                                    o = n.ui,
                                    s =
                                        o.startEditable ||
                                        (function (e, t) {
                                            var r = e.resourceEditable;
                                            if (null == r) {
                                                var n = e.sourceId && t.state.eventSources[e.sourceId];
                                                n && (r = n.extendedProps.resourceEditable), null == r && null == (r = t.opt("eventResourceEditable")) && (r = !0);
                                            }
                                            return r;
                                        })(i, this.timeAxis.calendar),
                                    a = e.isStart && o.durationEditable && this.context.options.eventResizableFromStart,
                                    l = e.isEnd && o.durationEditable,
                                    c = this.getSegClasses(e, s, a || l, r);
                                c.unshift("fc-timeline-event", "fc-h-event");
                                var u = this.getTimeText(n);
                                return (
                                    '<a class="' +
                                    c.join(" ") +
                                    '" style="' +
                                    t.cssToStr(this.getSkinCss(o)) +
                                    '"' +
                                    (i.url ? ' href="' + t.htmlEscape(i.url) + '"' : "") +
                                    '><div class="fc-content">' +
                                    (u ? '<span class="fc-time">' + t.htmlEscape(u) + "</span>" : "") +
                                    '<span class="fc-title fc-sticky">' +
                                    (i.title ? t.htmlEscape(i.title) : "&nbsp;") +
                                    "</span></div>" +
                                    (a ? '<div class="fc-resizer fc-start-resizer"></div>' : "") +
                                    (l ? '<div class="fc-resizer fc-end-resizer"></div>' : "") +
                                    "</a>"
                                );
                            }),
                            (r.prototype.computeDisplayEventTime = function () {
                                return !this.timeAxis.tDateProfile.isTimeScale;
                            }),
                            (r.prototype.computeDisplayEventEnd = function () {
                                return !1;
                            }),
                            (r.prototype.computeEventTimeFormat = function () {
                                return { hour: "numeric", minute: "2-digit", omitZeroMinute: !0, meridiem: "narrow" };
                            }),
                            (r.prototype.attachSegs = function (e, r) {
                                if (
                                    (!this.el &&
                                        this.masterContainerEl &&
                                        ((this.el = t.createElement("div", { className: "fc-event-container" })), r && this.el.classList.add("fc-mirror-container"), this.masterContainerEl.appendChild(this.el)),
                                    this.el)
                                )
                                    for (var n = 0, i = e; n < i.length; n++) {
                                        var o = i[n];
                                        this.el.appendChild(o.el);
                                    }
                            }),
                            (r.prototype.detachSegs = function (e) {
                                for (var r = 0, n = e; r < n.length; r++) {
                                    var i = n[r];
                                    t.removeElement(i.el);
                                }
                            }),
                            (r.prototype.computeSegSizes = function (e) {
                                for (var r = this.timeAxis, n = 0, i = e; n < i.length; n++) {
                                    var o = i[n],
                                        s = r.rangeToCoords(o);
                                    t.applyStyle(o.el, { left: (o.left = s.left), right: -(o.right = s.right) });
                                }
                            }),
                            (r.prototype.assignSegSizes = function (e) {
                                if (this.el) {
                                    for (var r = 0, n = e; r < n.length; r++) {
                                        var i = n[r];
                                        i.height = t.computeHeightAndMargins(i.el);
                                    }
                                    this.buildSegLevels(e);
                                    var o = O(e);
                                    t.applyStyleProp(this.el, "height", o);
                                    for (var s = 0, a = e; s < a.length; s++) {
                                        var i = a[s];
                                        t.applyStyleProp(i.el, "top", i.top);
                                    }
                                }
                            }),
                            (r.prototype.buildSegLevels = function (e) {
                                var t = [];
                                e = this.sortEventSegs(e);
                                for (var r = 0, n = e; r < n.length; r++) {
                                    var i = n[r];
                                    i.above = [];
                                    for (var o = 0; o < t.length; ) {
                                        for (var s = !1, a = 0, l = t[o]; a < l.length; a++) {
                                            var c = l[a];
                                            L(i, c) && (i.above.push(c), (s = !0));
                                        }
                                        if (!s) break;
                                        o += 1;
                                    }
                                    for ((t[o] || (t[o] = [])).push(i), o += 1; o < t.length; ) {
                                        for (var u = 0, d = t[o]; u < d.length; u++) {
                                            var h = d[u];
                                            L(i, h) && h.above.push(i);
                                        }
                                        o += 1;
                                    }
                                }
                                return t;
                            }),
                            r
                        );
                    })(t.FgEventRenderer);
                function O(e) {
                    for (var t = 0, r = 0, n = e; r < n.length; r++) {
                        var i = n[r];
                        t = Math.max(t, z(i));
                    }
                    return t;
                }
                function z(e) {
                    return null == e.top && (e.top = O(e.above)), e.top + e.height;
                }
                function L(e, t) {
                    return e.left < t.right && e.right > t.left;
                }
                var N = (function (e) {
                        function r(t, r, n) {
                            var i = e.call(this, t) || this;
                            return (i.masterContainerEl = r), (i.timeAxis = n), i;
                        }
                        return (
                            n(r, e),
                            (r.prototype.attachSegs = function (e, r) {
                                if (r.length) {
                                    var n = void 0;
                                    n = "businessHours" === e ? "bgevent" : e.toLowerCase();
                                    var i = t.createElement("div", { className: "fc-" + n + "-container" });
                                    this.masterContainerEl.appendChild(i);
                                    for (var o = 0, s = r; o < s.length; o++) {
                                        var a = s[o];
                                        i.appendChild(a.el);
                                    }
                                    return [i];
                                }
                            }),
                            (r.prototype.computeSegSizes = function (e) {
                                for (var t = this.timeAxis, r = 0, n = e; r < n.length; r++) {
                                    var i = n[r],
                                        o = t.rangeToCoords(i);
                                    (i.left = o.left), (i.right = o.right);
                                }
                            }),
                            (r.prototype.assignSegSizes = function (e) {
                                for (var r = 0, n = e; r < n.length; r++) {
                                    var i = n[r];
                                    t.applyStyle(i.el, { left: i.left, right: -i.right });
                                }
                            }),
                            r
                        );
                    })(t.FillRenderer),
                    A = (function (e) {
                        function r(r, n, i, o) {
                            var s = e.call(this, r, i) || this;
                            (s.slicer = new B()), (s.renderEventDrag = t.memoizeRendering(s._renderEventDrag, s._unrenderEventDrag)), (s.renderEventResize = t.memoizeRendering(s._renderEventResize, s._unrenderEventResize));
                            var a = (s.fillRenderer = new N(r, i, o)),
                                l = (s.eventRenderer = new x(r, n, o));
                            return (
                                (s.mirrorRenderer = new x(r, n, o)),
                                (s.renderBusinessHours = t.memoizeRendering(a.renderSegs.bind(a, "businessHours"), a.unrender.bind(a, "businessHours"))),
                                (s.renderDateSelection = t.memoizeRendering(a.renderSegs.bind(a, "highlight"), a.unrender.bind(a, "highlight"))),
                                (s.renderBgEvents = t.memoizeRendering(a.renderSegs.bind(a, "bgEvent"), a.unrender.bind(a, "bgEvent"))),
                                (s.renderFgEvents = t.memoizeRendering(l.renderSegs.bind(l), l.unrender.bind(l))),
                                (s.renderEventSelection = t.memoizeRendering(l.selectByInstanceId.bind(l), l.unselectByInstanceId.bind(l), [s.renderFgEvents])),
                                (s.timeAxis = o),
                                s
                            );
                        }
                        return (
                            n(r, e),
                            (r.prototype.render = function (e) {
                                var t = this.slicer.sliceProps(e, e.dateProfile, this.timeAxis.tDateProfile.isTimeScale ? null : e.nextDayThreshold, this, this.timeAxis);
                                this.renderBusinessHours(t.businessHourSegs),
                                    this.renderDateSelection(t.dateSelectionSegs),
                                    this.renderBgEvents(t.bgEventSegs),
                                    this.renderFgEvents(t.fgEventSegs),
                                    this.renderEventSelection(t.eventSelection),
                                    this.renderEventDrag(t.eventDrag),
                                    this.renderEventResize(t.eventResize);
                            }),
                            (r.prototype.destroy = function () {
                                e.prototype.destroy.call(this),
                                    this.renderBusinessHours.unrender(),
                                    this.renderDateSelection.unrender(),
                                    this.renderBgEvents.unrender(),
                                    this.renderFgEvents.unrender(),
                                    this.renderEventSelection.unrender(),
                                    this.renderEventDrag.unrender(),
                                    this.renderEventResize.unrender();
                            }),
                            (r.prototype._renderEventDrag = function (e) {
                                e && (this.eventRenderer.hideByHash(e.affectedInstances), this.mirrorRenderer.renderSegs(e.segs, { isDragging: !0, sourceSeg: e.sourceSeg }));
                            }),
                            (r.prototype._unrenderEventDrag = function (e) {
                                e && (this.eventRenderer.showByHash(e.affectedInstances), this.mirrorRenderer.unrender(e.segs, { isDragging: !0, sourceSeg: e.sourceSeg }));
                            }),
                            (r.prototype._renderEventResize = function (e) {
                                if (e) {
                                    var t = e.segs.map(function (e) {
                                        return o({}, e);
                                    });
                                    this.eventRenderer.hideByHash(e.affectedInstances), this.fillRenderer.renderSegs("highlight", t), this.mirrorRenderer.renderSegs(e.segs, { isDragging: !0, sourceSeg: e.sourceSeg });
                                }
                            }),
                            (r.prototype._unrenderEventResize = function (e) {
                                e && (this.eventRenderer.showByHash(e.affectedInstances), this.fillRenderer.unrender("highlight"), this.mirrorRenderer.unrender(e.segs, { isDragging: !0, sourceSeg: e.sourceSeg }));
                            }),
                            (r.prototype.updateSize = function (e) {
                                var t = this.fillRenderer,
                                    r = this.eventRenderer,
                                    n = this.mirrorRenderer;
                                t.computeSizes(e), r.computeSizes(e), n.computeSizes(e), t.assignSizes(e), r.assignSizes(e), n.assignSizes(e);
                            }),
                            r
                        );
                    })(t.DateComponent),
                    B = (function (e) {
                        function r() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            n(r, e),
                            (r.prototype.sliceRange = function (e, r) {
                                var n = r.tDateProfile,
                                    i = r.props.dateProfile,
                                    o = (function (e, r, n) {
                                        if (!r.isTimeScale && ((e = t.computeVisibleDayRange(e)), r.largeUnit)) {
                                            var i = e;
                                            ((e = { start: n.startOf(e.start, r.largeUnit), end: n.startOf(e.end, r.largeUnit) }).end.valueOf() !== i.end.valueOf() || e.end <= e.start) &&
                                                (e = { start: e.start, end: n.add(e.end, r.slotDuration) });
                                        }
                                        return e;
                                    })(e, n, r.dateEnv),
                                    s = [];
                                if (r.computeDateSnapCoverage(o.start) < r.computeDateSnapCoverage(o.end)) {
                                    var a = t.intersectRanges(o, n.normalizedRange);
                                    a &&
                                        s.push({ start: a.start, end: a.end, isStart: a.start.valueOf() === o.start.valueOf() && E(a.start, n, i, r.view), isEnd: a.end.valueOf() === o.end.valueOf() && E(t.addMs(a.end, -1), n, i, r.view) });
                                }
                                return s;
                            }),
                            r
                        );
                    })(t.Slicer),
                    V = (function (e) {
                        function t(t, r, n, i) {
                            var o = e.call(this, t, r, n, i) || this;
                            return (
                                o.el.classList.add("fc-timeline"),
                                !1 === o.opt("eventOverlap") && o.el.classList.add("fc-no-overlap"),
                                (o.el.innerHTML = o.renderSkeletonHtml()),
                                (o.timeAxis = new _(o.context, o.el.querySelector("thead .fc-time-area"), o.el.querySelector("tbody .fc-time-area"))),
                                (o.lane = new A(o.context, o.timeAxis.layout.bodyScroller.enhancedScroll.canvas.contentEl, o.timeAxis.layout.bodyScroller.enhancedScroll.canvas.bgEl, o.timeAxis)),
                                t.calendar.registerInteractiveComponent(o, { el: o.timeAxis.slats.el }),
                                o
                            );
                        }
                        return (
                            n(t, e),
                            (t.prototype.destroy = function () {
                                this.timeAxis.destroy(), this.lane.destroy(), e.prototype.destroy.call(this), this.calendar.unregisterInteractiveComponent(this);
                            }),
                            (t.prototype.renderSkeletonHtml = function () {
                                var e = this.theme;
                                return (
                                    '<table class="' +
                                    e.getClass("tableGrid") +
                                    '"> <thead class="fc-head"> <tr> <td class="fc-time-area ' +
                                    e.getClass("widgetHeader") +
                                    '"></td> </tr> </thead> <tbody class="fc-body"> <tr> <td class="fc-time-area ' +
                                    e.getClass("widgetContent") +
                                    '"></td> </tr> </tbody> </table>'
                                );
                            }),
                            (t.prototype.render = function (t) {
                                e.prototype.render.call(this, t), this.timeAxis.receiveProps({ dateProfile: t.dateProfile }), this.lane.receiveProps(o({}, t, { nextDayThreshold: this.nextDayThreshold }));
                            }),
                            (t.prototype.updateSize = function (e, t, r) {
                                this.timeAxis.updateSize(e, t, r), this.lane.updateSize(e);
                            }),
                            (t.prototype.getNowIndicatorUnit = function (e) {
                                return this.timeAxis.getNowIndicatorUnit(e);
                            }),
                            (t.prototype.renderNowIndicator = function (e) {
                                this.timeAxis.renderNowIndicator(e);
                            }),
                            (t.prototype.unrenderNowIndicator = function () {
                                this.timeAxis.unrenderNowIndicator();
                            }),
                            (t.prototype.computeInitialDateScroll = function () {
                                return this.timeAxis.computeInitialDateScroll();
                            }),
                            (t.prototype.applyScroll = function (t, r) {
                                e.prototype.applyScroll.call(this, t, r);
                                var n = this.calendar;
                                (r || n.isViewUpdated || n.isDatesUpdated || n.isEventsUpdated) && this.timeAxis.updateStickyScrollers();
                            }),
                            (t.prototype.applyDateScroll = function (e) {
                                this.timeAxis.applyDateScroll(e);
                            }),
                            (t.prototype.queryScroll = function () {
                                var e = this.timeAxis.layout.bodyScroller.enhancedScroll;
                                return { top: e.getScrollTop(), left: e.getScrollLeft() };
                            }),
                            (t.prototype.queryHit = function (e, t, r, n) {
                                var i = this.timeAxis.slats.positionToHit(e);
                                if (i) return { component: this, dateSpan: i.dateSpan, rect: { left: i.left, right: i.right, top: 0, bottom: n }, dayEl: i.dayEl, layer: 0 };
                            }),
                            t
                        );
                    })(t.View),
                    U = t.createPlugin({
                        defaultView: "timelineDay",
                        views: {
                            timeline: { class: V, eventResizableFromStart: !0 },
                            timelineDay: { type: "timeline", duration: { days: 1 } },
                            timelineWeek: { type: "timeline", duration: { weeks: 1 } },
                            timelineMonth: { type: "timeline", duration: { months: 1 } },
                            timelineYear: { type: "timeline", duration: { years: 1 } },
                        },
                    });
                (e.HeaderBodyLayout = d), (e.ScrollJoiner = u), (e.StickyScroller = k), (e.TimeAxis = _), (e.TimelineLane = A), (e.TimelineView = V), (e.default = U), Object.defineProperty(e, "__esModule", { value: !0 });
            })(t, r(13));
        },
        484: function (e, t, r) {
            "use strict";
            r.r(t),
                r.d(t, "calendarPlugins", function () {
                    return v;
                });
            var n = r(13);
            r.n(n),
                r.d(t, "Calendar", function () {
                    return n.Calendar;
                });
            var i = r(250),
                o = r.n(i),
                s = r(65),
                a = r.n(s),
                l = r(251),
                c = r.n(l),
                u = r(252),
                d = r.n(u),
                h = r(253),
                p = r.n(h),
                f = r(254),
                g = r.n(f),
                v = { bootstrap: o.a, dayGrid: a.a, interaction: c.a, list: d.a, timeGrid: p.a, timeline: g.a };
        },
        65: function (e, t, r) {
            /*!
@fullcalendar/daygrid v4.0.1
Docs & License: https://fullcalendar.io/
(c) 2019 Adam Shaw
*/
            !(function (e, t) {
                "use strict";
                /*! *****************************************************************************
    Copyright (c) Microsoft Corporation. All rights reserved.
    Licensed under the Apache License, Version 2.0 (the "License"); you may not use
    this file except in compliance with the License. You may obtain a copy of the
    License at http://www.apache.org/licenses/LICENSE-2.0

    THIS CODE IS PROVIDED ON AN *AS IS* BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
    KIND, EITHER EXPRESS OR IMPLIED, INCLUDING WITHOUT LIMITATION ANY IMPLIED
    WARRANTIES OR CONDITIONS OF TITLE, FITNESS FOR A PARTICULAR PURPOSE,
    MERCHANTABLITY OR NON-INFRINGEMENT.

    See the Apache Version 2.0 License for specific language governing permissions
    and limitations under the License.
    ***************************************************************************** */ var r = function (
                    e,
                    t
                ) {
                    return (r =
                        Object.setPrototypeOf ||
                        ({ __proto__: [] } instanceof Array &&
                            function (e, t) {
                                e.__proto__ = t;
                            }) ||
                        function (e, t) {
                            for (var r in t) t.hasOwnProperty(r) && (e[r] = t[r]);
                        })(e, t);
                };
                function n(e, t) {
                    function n() {
                        this.constructor = e;
                    }
                    r(e, t), (e.prototype = null === t ? Object.create(t) : ((n.prototype = t.prototype), new n()));
                }
                var i = function () {
                        return (i =
                            Object.assign ||
                            function (e) {
                                for (var t, r = 1, n = arguments.length; r < n; r++) for (var i in (t = arguments[r])) Object.prototype.hasOwnProperty.call(t, i) && (e[i] = t[i]);
                                return e;
                            }).apply(this, arguments);
                    },
                    o = (function (e) {
                        function r() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            n(r, e),
                            (r.prototype.buildRenderRange = function (r, n, i) {
                                var o,
                                    s = this.dateEnv,
                                    a = e.prototype.buildRenderRange.call(this, r, n, i),
                                    l = a.start,
                                    c = a.end;
                                if ((/^(year|month)$/.test(n) && ((l = s.startOfWeek(l)), (o = s.startOfWeek(c)).valueOf() !== c.valueOf() && (c = t.addWeeks(o, 1))), this.options.monthMode && this.options.fixedWeekCount)) {
                                    var u = Math.ceil(t.diffWeeks(l, c));
                                    c = t.addWeeks(c, 6 - u);
                                }
                                return { start: l, end: c };
                            }),
                            r
                        );
                    })(t.DateProfileGenerator),
                    s = (function () {
                        function e(e) {
                            var t = this;
                            (this.isHidden = !0),
                                (this.margin = 10),
                                (this.documentMousedown = function (e) {
                                    t.el && !t.el.contains(e.target) && t.hide();
                                }),
                                (this.options = e);
                        }
                        return (
                            (e.prototype.show = function () {
                                this.isHidden && (this.el || this.render(), (this.el.style.display = ""), this.position(), (this.isHidden = !1), this.trigger("show"));
                            }),
                            (e.prototype.hide = function () {
                                this.isHidden || ((this.el.style.display = "none"), (this.isHidden = !0), this.trigger("hide"));
                            }),
                            (e.prototype.render = function () {
                                var e = this,
                                    r = this.options,
                                    n = (this.el = t.createElement("div", { className: "fc-popover " + (r.className || ""), style: { top: "0", left: "0" } }));
                                "function" == typeof r.content && r.content(n),
                                    r.parentEl.appendChild(n),
                                    t.listenBySelector(n, "click", ".fc-close", function (t) {
                                        e.hide();
                                    }),
                                    r.autoHide && document.addEventListener("mousedown", this.documentMousedown);
                            }),
                            (e.prototype.destroy = function () {
                                this.hide(), this.el && (t.removeElement(this.el), (this.el = null)), document.removeEventListener("mousedown", this.documentMousedown);
                            }),
                            (e.prototype.position = function () {
                                var e,
                                    r,
                                    n = this.options,
                                    i = this.el,
                                    o = i.getBoundingClientRect(),
                                    s = t.computeRect(i.offsetParent),
                                    a = t.computeClippingRect(n.parentEl);
                                (e = n.top || 0),
                                    (r = void 0 !== n.left ? n.left : void 0 !== n.right ? n.right - o.width : 0),
                                    (e = Math.min(e, a.bottom - o.height - this.margin)),
                                    (e = Math.max(e, a.top + this.margin)),
                                    (r = Math.min(r, a.right - o.width - this.margin)),
                                    (r = Math.max(r, a.left + this.margin)),
                                    t.applyStyle(i, { top: e - s.top, left: r - s.left });
                            }),
                            (e.prototype.trigger = function (e) {
                                this.options[e] && this.options[e].apply(this, Array.prototype.slice.call(arguments, 1));
                            }),
                            e
                        );
                    })(),
                    a = (function (e) {
                        function r() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            n(r, e),
                            (r.prototype.renderSegHtml = function (e, r) {
                                var n,
                                    i,
                                    o = this.context.options,
                                    s = e.eventRange,
                                    a = s.def,
                                    l = s.ui,
                                    c = a.allDay,
                                    u = l.startEditable,
                                    d = c && e.isStart && l.durationEditable && o.eventResizableFromStart,
                                    h = c && e.isEnd && l.durationEditable,
                                    p = this.getSegClasses(e, u, d || h, r),
                                    f = t.cssToStr(this.getSkinCss(l)),
                                    g = "";
                                return (
                                    p.unshift("fc-day-grid-event", "fc-h-event"),
                                    e.isStart && (n = this.getTimeText(s)) && (g = '<span class="fc-time">' + t.htmlEscape(n) + "</span>"),
                                    (i = '<span class="fc-title">' + (t.htmlEscape(a.title || "") || "&nbsp;") + "</span>"),
                                    '<a class="' +
                                        p.join(" ") +
                                        '"' +
                                        (a.url ? ' href="' + t.htmlEscape(a.url) + '"' : "") +
                                        (f ? ' style="' + f + '"' : "") +
                                        '><div class="fc-content">' +
                                        ("rtl" === o.dir ? i + " " + g : g + " " + i) +
                                        "</div>" +
                                        (d ? '<div class="fc-resizer fc-start-resizer"></div>' : "") +
                                        (h ? '<div class="fc-resizer fc-end-resizer"></div>' : "") +
                                        "</a>"
                                );
                            }),
                            (r.prototype.computeEventTimeFormat = function () {
                                return { hour: "numeric", minute: "2-digit", omitZeroMinute: !0, meridiem: "narrow" };
                            }),
                            (r.prototype.computeDisplayEventEnd = function () {
                                return !1;
                            }),
                            r
                        );
                    })(t.FgEventRenderer),
                    l = (function (e) {
                        function r(t) {
                            var r = e.call(this, t.context) || this;
                            return (r.dayGrid = t), r;
                        }
                        return (
                            n(r, e),
                            (r.prototype.attachSegs = function (e, t) {
                                var r = (this.rowStructs = this.renderSegRows(e));
                                this.dayGrid.rowEls.forEach(function (e, t) {
                                    e.querySelector(".fc-content-skeleton > table").appendChild(r[t].tbodyEl);
                                }),
                                    t || this.dayGrid.removeSegPopover();
                            }),
                            (r.prototype.detachSegs = function () {
                                for (var e, r = this.rowStructs || []; (e = r.pop()); ) t.removeElement(e.tbodyEl);
                                this.rowStructs = null;
                            }),
                            (r.prototype.renderSegRows = function (e) {
                                var t,
                                    r,
                                    n = [];
                                for (t = this.groupSegRows(e), r = 0; r < t.length; r++) n.push(this.renderSegRow(r, t[r]));
                                return n;
                            }),
                            (r.prototype.renderSegRow = function (e, r) {
                                var n,
                                    i,
                                    o,
                                    s,
                                    a,
                                    l,
                                    c,
                                    u = this.dayGrid,
                                    d = u.colCnt,
                                    h = u.isRtl,
                                    p = this.buildSegLevels(r),
                                    f = Math.max(1, p.length),
                                    g = document.createElement("tbody"),
                                    v = [],
                                    m = [],
                                    y = [];
                                function S(e) {
                                    for (; o < e; ) (c = (y[n - 1] || [])[o]) ? (c.rowSpan = (c.rowSpan || 1) + 1) : ((c = document.createElement("td")), s.appendChild(c)), (m[n][o] = c), (y[n][o] = c), o++;
                                }
                                for (n = 0; n < f; n++) {
                                    if (((i = p[n]), (o = 0), (s = document.createElement("tr")), v.push([]), m.push([]), y.push([]), i))
                                        for (a = 0; a < i.length; a++) {
                                            l = i[a];
                                            var E = h ? d - 1 - l.lastCol : l.firstCol,
                                                b = h ? d - 1 - l.firstCol : l.lastCol;
                                            for (S(E), c = t.createElement("td", { className: "fc-event-container" }, l.el), E !== b ? (c.colSpan = b - E + 1) : (y[n][o] = c); o <= b; ) (m[n][o] = c), (v[n][o] = l), o++;
                                            s.appendChild(c);
                                        }
                                    S(d);
                                    var D = u.renderProps.renderIntroHtml();
                                    D && (u.isRtl ? t.appendToElement(s, D) : t.prependToElement(s, D)), g.appendChild(s);
                                }
                                return { row: e, tbodyEl: g, cellMatrix: m, segMatrix: v, segLevels: p, segs: r };
                            }),
                            (r.prototype.buildSegLevels = function (e) {
                                var t,
                                    r,
                                    n,
                                    i = this.dayGrid,
                                    o = i.isRtl,
                                    s = i.colCnt,
                                    a = [];
                                for (e = this.sortEventSegs(e), t = 0; t < e.length; t++) {
                                    for (r = e[t], n = 0; n < a.length && c(r, a[n]); n++);
                                    (r.level = n), (r.leftCol = o ? s - 1 - r.lastCol : r.firstCol), (r.rightCol = o ? s - 1 - r.firstCol : r.lastCol), (a[n] || (a[n] = [])).push(r);
                                }
                                for (n = 0; n < a.length; n++) a[n].sort(u);
                                return a;
                            }),
                            (r.prototype.groupSegRows = function (e) {
                                var t,
                                    r = [];
                                for (t = 0; t < this.dayGrid.rowCnt; t++) r.push([]);
                                for (t = 0; t < e.length; t++) r[e[t].row].push(e[t]);
                                return r;
                            }),
                            (r.prototype.computeDisplayEventEnd = function () {
                                return 1 === this.dayGrid.colCnt;
                            }),
                            r
                        );
                    })(a);
                function c(e, t) {
                    var r, n;
                    for (r = 0; r < t.length; r++) if ((n = t[r]).firstCol <= e.lastCol && n.lastCol >= e.firstCol) return !0;
                    return !1;
                }
                function u(e, t) {
                    return e.leftCol - t.leftCol;
                }
                var d = (function (e) {
                        function r() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            n(r, e),
                            (r.prototype.attachSegs = function (e, r) {
                                var n = r.sourceSeg,
                                    i = (this.rowStructs = this.renderSegRows(e));
                                this.dayGrid.rowEls.forEach(function (e, r) {
                                    var o,
                                        s,
                                        a = t.htmlToElement('<div class="fc-mirror-skeleton"><table></table></div>');
                                    n && n.row === r ? (o = n.el) : (o = e.querySelector(".fc-content-skeleton tbody")) || (o = e.querySelector(".fc-content-skeleton table")),
                                        (s = o.getBoundingClientRect().top - e.getBoundingClientRect().top),
                                        (a.style.top = s + "px"),
                                        a.querySelector("table").appendChild(i[r].tbodyEl),
                                        e.appendChild(a);
                                });
                            }),
                            r
                        );
                    })(l),
                    h = (function (e) {
                        function r(t) {
                            var r = e.call(this, t.context) || this;
                            return (r.fillSegTag = "td"), (r.dayGrid = t), r;
                        }
                        return (
                            n(r, e),
                            (r.prototype.renderSegs = function (t, r) {
                                "bgEvent" === t &&
                                    (r = r.filter(function (e) {
                                        return e.eventRange.def.allDay;
                                    })),
                                    e.prototype.renderSegs.call(this, t, r);
                            }),
                            (r.prototype.attachSegs = function (e, t) {
                                var r,
                                    n,
                                    i,
                                    o = [];
                                for (r = 0; r < t.length; r++) (n = t[r]), (i = this.renderFillRow(e, n)), this.dayGrid.rowEls[n.row].appendChild(i), o.push(i);
                                return o;
                            }),
                            (r.prototype.renderFillRow = function (e, r) {
                                var n,
                                    i,
                                    o,
                                    s = this.dayGrid,
                                    a = s.colCnt,
                                    l = s.isRtl,
                                    c = l ? a - 1 - r.lastCol : r.firstCol,
                                    u = l ? a - 1 - r.firstCol : r.lastCol,
                                    d = c,
                                    h = u + 1;
                                (n = "businessHours" === e ? "bgevent" : e.toLowerCase()),
                                    (i = t.htmlToElement('<div class="fc-' + n + '-skeleton"><table><tr></tr></table></div>')),
                                    (o = i.getElementsByTagName("tr")[0]),
                                    d > 0 && t.appendToElement(o, new Array(d + 1).join("<td></td>")),
                                    (r.el.colSpan = h - d),
                                    o.appendChild(r.el),
                                    h < a && t.appendToElement(o, new Array(a - h + 1).join("<td></td>"));
                                var p = s.renderProps.renderIntroHtml();
                                return p && (s.isRtl ? t.appendToElement(o, p) : t.prependToElement(o, p)), i;
                            }),
                            r
                        );
                    })(t.FillRenderer),
                    p = (function (e) {
                        function r(r, n) {
                            var i = e.call(this, r, n) || this,
                                o = (i.eventRenderer = new f(i)),
                                s = (i.renderFrame = t.memoizeRendering(i._renderFrame));
                            return (
                                (i.renderFgEvents = t.memoizeRendering(o.renderSegs.bind(o), o.unrender.bind(o), [s])),
                                (i.renderEventSelection = t.memoizeRendering(o.selectByInstanceId.bind(o), o.unselectByInstanceId.bind(o), [i.renderFgEvents])),
                                (i.renderEventDrag = t.memoizeRendering(o.hideByHash.bind(o), o.showByHash.bind(o), [s])),
                                (i.renderEventResize = t.memoizeRendering(o.hideByHash.bind(o), o.showByHash.bind(o), [s])),
                                r.calendar.registerInteractiveComponent(i, { el: i.el, useEventCenter: !1 }),
                                i
                            );
                        }
                        return (
                            n(r, e),
                            (r.prototype.render = function (e) {
                                this.renderFrame(e.date), this.renderFgEvents(e.fgSegs), this.renderEventSelection(e.eventSelection), this.renderEventDrag(e.eventDragInstances), this.renderEventResize(e.eventResizeInstances);
                            }),
                            (r.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.renderFrame.unrender(), this.calendar.unregisterInteractiveComponent(this);
                            }),
                            (r.prototype._renderFrame = function (e) {
                                var r = this.theme,
                                    n = this.dateEnv,
                                    i = n.format(e, t.createFormatter(this.opt("dayPopoverFormat")));
                                (this.el.innerHTML =
                                    '<div class="fc-header ' +
                                    r.getClass("popoverHeader") +
                                    '"><span class="fc-title">' +
                                    t.htmlEscape(i) +
                                    '</span><span class="fc-close ' +
                                    r.getIconClass("close") +
                                    '"></span></div><div class="fc-body ' +
                                    r.getClass("popoverContent") +
                                    '"><div class="fc-event-container"></div></div>'),
                                    (this.segContainerEl = this.el.querySelector(".fc-event-container"));
                            }),
                            (r.prototype.queryHit = function (e, r, n, i) {
                                var o = this.props.date;
                                if (e < n && r < i) return { component: this, dateSpan: { allDay: !0, range: { start: o, end: t.addDays(o, 1) } }, dayEl: this.el, rect: { left: 0, top: 0, right: n, bottom: i }, layer: 1 };
                            }),
                            r
                        );
                    })(t.DateComponent),
                    f = (function (e) {
                        function r(t) {
                            var r = e.call(this, t.context) || this;
                            return (r.dayTile = t), r;
                        }
                        return (
                            n(r, e),
                            (r.prototype.attachSegs = function (e) {
                                for (var t = 0, r = e; t < r.length; t++) {
                                    var n = r[t];
                                    this.dayTile.segContainerEl.appendChild(n.el);
                                }
                            }),
                            (r.prototype.detachSegs = function (e) {
                                for (var r = 0, n = e; r < n.length; r++) {
                                    var i = n[r];
                                    t.removeElement(i.el);
                                }
                            }),
                            r
                        );
                    })(a),
                    g = (function () {
                        function e(e) {
                            this.context = e;
                        }
                        return (
                            (e.prototype.renderHtml = function (e) {
                                var t = [];
                                e.renderIntroHtml && t.push(e.renderIntroHtml());
                                for (var r = 0, n = e.cells; r < n.length; r++) {
                                    var i = n[r];
                                    t.push(v(i.date, e.dateProfile, this.context, i.htmlAttrs));
                                }
                                return e.cells.length || t.push('<td class="fc-day ' + this.context.theme.getClass("widgetContent") + '"></td>'), "rtl" === this.context.options.dir && t.reverse(), "<tr>" + t.join("") + "</tr>";
                            }),
                            e
                        );
                    })();
                function v(e, r, n, i) {
                    var o = n.dateEnv,
                        s = n.theme,
                        a = t.rangeContainsMarker(r.activeRange, e),
                        l = t.getDayClasses(e, r, n);
                    return l.unshift("fc-day", s.getClass("widgetContent")), '<td class="' + l.join(" ") + '"' + (a ? ' data-date="' + o.formatIso(e, { omitTime: !0 }) + '"' : "") + (i ? " " + i : "") + "></td>";
                }
                var m = t.createFormatter({ day: "numeric" }),
                    y = t.createFormatter({ week: "numeric" }),
                    S = (function (e) {
                        function r(r, n, i) {
                            var o = e.call(this, r, n) || this;
                            (o.bottomCoordPadding = 0), (o.isCellSizesDirty = !1);
                            var s = (o.eventRenderer = new l(o)),
                                a = (o.fillRenderer = new h(o));
                            o.mirrorRenderer = new d(o);
                            var c = (o.renderCells = t.memoizeRendering(o._renderCells, o._unrenderCells));
                            return (
                                (o.renderBusinessHours = t.memoizeRendering(a.renderSegs.bind(a, "businessHours"), a.unrender.bind(a, "businessHours"), [c])),
                                (o.renderDateSelection = t.memoizeRendering(a.renderSegs.bind(a, "highlight"), a.unrender.bind(a, "highlight"), [c])),
                                (o.renderBgEvents = t.memoizeRendering(a.renderSegs.bind(a, "bgEvent"), a.unrender.bind(a, "bgEvent"), [c])),
                                (o.renderFgEvents = t.memoizeRendering(s.renderSegs.bind(s), s.unrender.bind(s), [c])),
                                (o.renderEventSelection = t.memoizeRendering(s.selectByInstanceId.bind(s), s.unselectByInstanceId.bind(s), [o.renderFgEvents])),
                                (o.renderEventDrag = t.memoizeRendering(o._renderEventDrag, o._unrenderEventDrag, [c])),
                                (o.renderEventResize = t.memoizeRendering(o._renderEventResize, o._unrenderEventResize, [c])),
                                (o.renderProps = i),
                                o
                            );
                        }
                        return (
                            n(r, e),
                            (r.prototype.render = function (e) {
                                var t = e.cells;
                                (this.rowCnt = t.length),
                                    (this.colCnt = t[0].length),
                                    this.renderCells(t, e.isRigid),
                                    this.renderBusinessHours(e.businessHourSegs),
                                    this.renderDateSelection(e.dateSelectionSegs),
                                    this.renderBgEvents(e.bgEventSegs),
                                    this.renderFgEvents(e.fgEventSegs),
                                    this.renderEventSelection(e.eventSelection),
                                    this.renderEventDrag(e.eventDrag),
                                    this.renderEventResize(e.eventResize),
                                    this.segPopoverTile && this.updateSegPopoverTile();
                            }),
                            (r.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.renderCells.unrender();
                            }),
                            (r.prototype.getCellRange = function (e, r) {
                                var n = this.props.cells[e][r].date,
                                    i = t.addDays(n, 1);
                                return { start: n, end: i };
                            }),
                            (r.prototype.updateSegPopoverTile = function (e, t) {
                                var r = this.props;
                                this.segPopoverTile.receiveProps({
                                    date: e || this.segPopoverTile.props.date,
                                    fgSegs: t || this.segPopoverTile.props.fgSegs,
                                    eventSelection: r.eventSelection,
                                    eventDragInstances: r.eventDrag ? r.eventDrag.affectedInstances : null,
                                    eventResizeInstances: r.eventResize ? r.eventResize.affectedInstances : null,
                                });
                            }),
                            (r.prototype._renderCells = function (e, r) {
                                var n,
                                    i,
                                    o = this.view,
                                    s = this.dateEnv,
                                    a = this.rowCnt,
                                    l = this.colCnt,
                                    c = "";
                                for (n = 0; n < a; n++) c += this.renderDayRowHtml(n, r);
                                for (
                                    this.el.innerHTML = c,
                                        this.rowEls = t.findElements(this.el, ".fc-row"),
                                        this.cellEls = t.findElements(this.el, ".fc-day, .fc-disabled-day"),
                                        this.isRtl && this.cellEls.reverse(),
                                        this.rowPositions = new t.PositionCache(this.el, this.rowEls, !1, !0),
                                        this.colPositions = new t.PositionCache(this.el, this.cellEls.slice(0, l), !0, !1),
                                        n = 0;
                                    n < a;
                                    n++
                                )
                                    for (i = 0; i < l; i++) this.publiclyTrigger("dayRender", [{ date: s.toDate(e[n][i].date), el: this.getCellEl(n, i), view: o }]);
                                this.isCellSizesDirty = !0;
                            }),
                            (r.prototype._unrenderCells = function () {
                                this.removeSegPopover();
                            }),
                            (r.prototype.renderDayRowHtml = function (e, t) {
                                var r = this.theme,
                                    n = ["fc-row", "fc-week", r.getClass("dayRow")];
                                t && n.push("fc-rigid");
                                var i = new g(this.context);
                                return (
                                    '<div class="' +
                                    n.join(" ") +
                                    '"><div class="fc-bg"><table class="' +
                                    r.getClass("tableGrid") +
                                    '">' +
                                    i.renderHtml({ cells: this.props.cells[e], dateProfile: this.props.dateProfile, renderIntroHtml: this.renderProps.renderBgIntroHtml }) +
                                    '</table></div><div class="fc-content-skeleton"><table>' +
                                    (this.getIsNumbersVisible() ? "<thead>" + this.renderNumberTrHtml(e) + "</thead>" : "") +
                                    "</table></div></div>"
                                );
                            }),
                            (r.prototype.getIsNumbersVisible = function () {
                                return this.getIsDayNumbersVisible() || this.renderProps.cellWeekNumbersVisible || this.renderProps.colWeekNumbersVisible;
                            }),
                            (r.prototype.getIsDayNumbersVisible = function () {
                                return this.rowCnt > 1;
                            }),
                            (r.prototype.renderNumberTrHtml = function (e) {
                                var t = this.renderProps.renderNumberIntroHtml(e, this);
                                return "<tr>" + (this.isRtl ? "" : t) + this.renderNumberCellsHtml(e) + (this.isRtl ? t : "") + "</tr>";
                            }),
                            (r.prototype.renderNumberCellsHtml = function (e) {
                                var t,
                                    r,
                                    n = [];
                                for (t = 0; t < this.colCnt; t++) (r = this.props.cells[e][t].date), n.push(this.renderNumberCellHtml(r));
                                return this.isRtl && n.reverse(), n.join("");
                            }),
                            (r.prototype.renderNumberCellHtml = function (e) {
                                var r,
                                    n,
                                    i = this.view,
                                    o = this.dateEnv,
                                    s = "",
                                    a = t.rangeContainsMarker(this.props.dateProfile.activeRange, e),
                                    l = this.getIsDayNumbersVisible() && a;
                                return l || this.renderProps.cellWeekNumbersVisible
                                    ? ((r = t.getDayClasses(e, this.props.dateProfile, this.context)).unshift("fc-day-top"),
                                      this.renderProps.cellWeekNumbersVisible && (n = o.weekDow),
                                      (s += '<td class="' + r.join(" ") + '"' + (a ? ' data-date="' + o.formatIso(e, { omitTime: !0 }) + '"' : "") + ">"),
                                      this.renderProps.cellWeekNumbersVisible && e.getUTCDay() === n && (s += t.buildGotoAnchorHtml(i, { date: e, type: "week" }, { class: "fc-week-number" }, o.format(e, y))),
                                      l && (s += t.buildGotoAnchorHtml(i, e, { class: "fc-day-number" }, o.format(e, m))),
                                      (s += "</td>"))
                                    : "<td></td>";
                            }),
                            (r.prototype.updateSize = function (e) {
                                var t = this.fillRenderer,
                                    r = this.eventRenderer,
                                    n = this.mirrorRenderer;
                                (e || this.isCellSizesDirty) && (this.buildColPositions(), this.buildRowPositions(), (this.isCellSizesDirty = !1)),
                                    t.computeSizes(e),
                                    r.computeSizes(e),
                                    n.computeSizes(e),
                                    t.assignSizes(e),
                                    r.assignSizes(e),
                                    n.assignSizes(e);
                            }),
                            (r.prototype.buildColPositions = function () {
                                this.colPositions.build();
                            }),
                            (r.prototype.buildRowPositions = function () {
                                this.rowPositions.build(), (this.rowPositions.bottoms[this.rowCnt - 1] += this.bottomCoordPadding);
                            }),
                            (r.prototype.positionToHit = function (e, t) {
                                var r = this.colPositions,
                                    n = this.rowPositions,
                                    i = r.leftToIndex(e),
                                    o = n.topToIndex(t);
                                if (null != o && null != i)
                                    return {
                                        row: o,
                                        col: i,
                                        dateSpan: { range: this.getCellRange(o, i), allDay: !0 },
                                        dayEl: this.getCellEl(o, i),
                                        relativeRect: { left: r.lefts[i], right: r.rights[i], top: n.tops[o], bottom: n.bottoms[o] },
                                    };
                            }),
                            (r.prototype.getCellEl = function (e, t) {
                                return this.cellEls[e * this.colCnt + t];
                            }),
                            (r.prototype._renderEventDrag = function (e) {
                                e && (this.eventRenderer.hideByHash(e.affectedInstances), this.fillRenderer.renderSegs("highlight", e.segs));
                            }),
                            (r.prototype._unrenderEventDrag = function (e) {
                                e && (this.eventRenderer.showByHash(e.affectedInstances), this.fillRenderer.unrender("highlight"));
                            }),
                            (r.prototype._renderEventResize = function (e) {
                                e && (this.eventRenderer.hideByHash(e.affectedInstances), this.fillRenderer.renderSegs("highlight", e.segs), this.mirrorRenderer.renderSegs(e.segs, { isResizing: !0, sourceSeg: e.sourceSeg }));
                            }),
                            (r.prototype._unrenderEventResize = function (e) {
                                e && (this.eventRenderer.showByHash(e.affectedInstances), this.fillRenderer.unrender("highlight"), this.mirrorRenderer.unrender(e.segs, { isResizing: !0, sourceSeg: e.sourceSeg }));
                            }),
                            (r.prototype.removeSegPopover = function () {
                                this.segPopover && this.segPopover.hide();
                            }),
                            (r.prototype.limitRows = function (e) {
                                var t,
                                    r,
                                    n = this.eventRenderer.rowStructs || [];
                                for (t = 0; t < n.length; t++) this.unlimitRow(t), !1 !== (r = !!e && ("number" == typeof e ? e : this.computeRowLevelLimit(t))) && this.limitRow(t, r);
                            }),
                            (r.prototype.computeRowLevelLimit = function (e) {
                                var r,
                                    n,
                                    i = this.rowEls[e],
                                    o = i.getBoundingClientRect().bottom,
                                    s = t.findChildren(this.eventRenderer.rowStructs[e].tbodyEl);
                                for (r = 0; r < s.length; r++) if (((n = s[r]).classList.remove("fc-limited"), n.getBoundingClientRect().bottom > o)) return r;
                                return !1;
                            }),
                            (r.prototype.limitRow = function (e, r) {
                                var n,
                                    i,
                                    o,
                                    s,
                                    a,
                                    l,
                                    c,
                                    u,
                                    d,
                                    h,
                                    p,
                                    f,
                                    g,
                                    v,
                                    m,
                                    y = this,
                                    S = this.colCnt,
                                    E = this.isRtl,
                                    b = this.eventRenderer.rowStructs[e],
                                    D = [],
                                    w = 0,
                                    T = function (n) {
                                        for (; w < n; ) (l = y.getCellSegs(e, w, r)).length && ((d = i[r - 1][w]), (m = y.renderMoreLink(e, w, l)), (v = t.createElement("div", null, m)), d.appendChild(v), D.push(v[0])), w++;
                                    };
                                if (r && r < b.segLevels.length) {
                                    for (
                                        n = b.segLevels[r - 1],
                                            i = b.cellMatrix,
                                            (o = t.findChildren(b.tbodyEl).slice(r)).forEach(function (e) {
                                                e.classList.add("fc-limited");
                                            }),
                                            s = 0;
                                        s < n.length;
                                        s++
                                    ) {
                                        a = n[s];
                                        var C = E ? S - 1 - a.lastCol : a.firstCol,
                                            R = E ? S - 1 - a.firstCol : a.lastCol;
                                        for (T(C), u = [], c = 0; w <= R; ) (l = this.getCellSegs(e, w, r)), u.push(l), (c += l.length), w++;
                                        if (c) {
                                            for (d = i[r - 1][C], h = d.rowSpan || 1, p = [], f = 0; f < u.length; f++)
                                                (g = t.createElement("td", { className: "fc-more-cell", rowSpan: h })),
                                                    (l = u[f]),
                                                    (m = this.renderMoreLink(e, C + f, [a].concat(l))),
                                                    (v = t.createElement("div", null, m)),
                                                    g.appendChild(v),
                                                    p.push(g),
                                                    D.push(g);
                                            d.classList.add("fc-limited"), t.insertAfterElement(d, p), o.push(d);
                                        }
                                    }
                                    T(this.colCnt), (b.moreEls = D), (b.limitedEls = o);
                                }
                            }),
                            (r.prototype.unlimitRow = function (e) {
                                var r = this.eventRenderer.rowStructs[e];
                                r.moreEls && (r.moreEls.forEach(t.removeElement), (r.moreEls = null)),
                                    r.limitedEls &&
                                        (r.limitedEls.forEach(function (e) {
                                            e.classList.remove("fc-limited");
                                        }),
                                        (r.limitedEls = null));
                            }),
                            (r.prototype.renderMoreLink = function (e, r, n) {
                                var i = this,
                                    o = this.view,
                                    s = this.dateEnv,
                                    a = t.createElement("a", { className: "fc-more" });
                                return (
                                    (a.innerText = this.getMoreLinkText(n.length)),
                                    a.addEventListener("click", function (t) {
                                        var a = i.opt("eventLimitClick"),
                                            l = i.isRtl ? i.colCnt - r - 1 : r,
                                            c = i.props.cells[e][l].date,
                                            u = t.currentTarget,
                                            d = i.getCellEl(e, r),
                                            h = i.getCellSegs(e, r),
                                            p = i.resliceDaySegs(h, c),
                                            f = i.resliceDaySegs(n, c);
                                        "function" == typeof a && (a = i.publiclyTrigger("eventLimitClick", [{ date: s.toDate(c), allDay: !0, dayEl: d, moreEl: u, segs: p, hiddenSegs: f, jsEvent: t, view: o }])),
                                            "popover" === a ? i.showSegPopover(e, r, u, p) : "string" == typeof a && o.calendar.zoomTo(c, a);
                                    }),
                                    a
                                );
                            }),
                            (r.prototype.showSegPopover = function (e, r, n, i) {
                                var o,
                                    a,
                                    l = this,
                                    c = this.calendar,
                                    u = this.view,
                                    d = this.theme,
                                    h = this.isRtl ? this.colCnt - r - 1 : r,
                                    f = n.parentNode;
                                (o = 1 === this.rowCnt ? u.el : this.rowEls[e]),
                                    (a = {
                                        className: "fc-more-popover " + d.getClass("popover"),
                                        parentEl: u.el,
                                        top: t.computeRect(o).top,
                                        autoHide: !0,
                                        content: function (t) {
                                            (l.segPopoverTile = new p(l.context, t)), l.updateSegPopoverTile(l.props.cells[e][h].date, i);
                                        },
                                        hide: function () {
                                            l.segPopoverTile.destroy(), (l.segPopoverTile = null), l.segPopover.destroy(), (l.segPopover = null);
                                        },
                                    }),
                                    this.isRtl ? (a.right = t.computeRect(f).right + 1) : (a.left = t.computeRect(f).left - 1),
                                    (this.segPopover = new s(a)),
                                    this.segPopover.show(),
                                    c.releaseAfterSizingTriggers();
                            }),
                            (r.prototype.resliceDaySegs = function (e, r) {
                                for (var n = r, o = t.addDays(n, 1), s = { start: n, end: o }, a = [], l = 0, c = e; l < c.length; l++) {
                                    var u = c[l],
                                        d = u.eventRange,
                                        h = d.range,
                                        p = t.intersectRanges(h, s);
                                    p &&
                                        a.push(
                                            i({}, u, {
                                                eventRange: { def: d.def, ui: i({}, d.ui, { durationEditable: !1 }), instance: d.instance, range: p },
                                                isStart: u.isStart && p.start.valueOf() === h.start.valueOf(),
                                                isEnd: u.isEnd && p.end.valueOf() === h.end.valueOf(),
                                            })
                                        );
                                }
                                return a;
                            }),
                            (r.prototype.getMoreLinkText = function (e) {
                                var t = this.opt("eventLimitText");
                                return "function" == typeof t ? t(e) : "+" + e + " " + t;
                            }),
                            (r.prototype.getCellSegs = function (e, t, r) {
                                for (var n, i = this.eventRenderer.rowStructs[e].segMatrix, o = r || 0, s = []; o < i.length; ) (n = i[o][t]) && s.push(n), o++;
                                return s;
                            }),
                            r
                        );
                    })(t.DateComponent),
                    E = t.createFormatter({ week: "numeric" }),
                    b = (function (e) {
                        function r(r, n, i, o) {
                            var s = e.call(this, r, n, i, o) || this;
                            (s.renderHeadIntroHtml = function () {
                                var e = s.theme;
                                return s.colWeekNumbersVisible ? '<th class="fc-week-number ' + e.getClass("widgetHeader") + '" ' + s.weekNumberStyleAttr() + "><span>" + t.htmlEscape(s.opt("weekLabel")) + "</span></th>" : "";
                            }),
                                (s.renderDayGridNumberIntroHtml = function (e, r) {
                                    var n = s.dateEnv,
                                        i = r.props.cells[e][0].date;
                                    return s.colWeekNumbersVisible
                                        ? '<td class="fc-week-number" ' + s.weekNumberStyleAttr() + ">" + t.buildGotoAnchorHtml(s, { date: i, type: "week", forceOff: 1 === r.colCnt }, n.format(i, E)) + "</td>"
                                        : "";
                                }),
                                (s.renderDayGridBgIntroHtml = function () {
                                    var e = s.theme;
                                    return s.colWeekNumbersVisible ? '<td class="fc-week-number ' + e.getClass("widgetContent") + '" ' + s.weekNumberStyleAttr() + "></td>" : "";
                                }),
                                (s.renderDayGridIntroHtml = function () {
                                    return s.colWeekNumbersVisible ? '<td class="fc-week-number" ' + s.weekNumberStyleAttr() + "></td>" : "";
                                }),
                                s.el.classList.add("fc-dayGrid-view"),
                                (s.el.innerHTML = s.renderSkeletonHtml()),
                                (s.scroller = new t.ScrollComponent("hidden", "auto"));
                            var a = s.scroller.el;
                            s.el.querySelector(".fc-body > tr > td").appendChild(a), a.classList.add("fc-day-grid-container");
                            var l,
                                c = t.createElement("div", { className: "fc-day-grid" });
                            return (
                                a.appendChild(c),
                                s.opt("weekNumbers") ? (s.opt("weekNumbersWithinDays") ? ((l = !0), (s.colWeekNumbersVisible = !1)) : ((l = !1), (s.colWeekNumbersVisible = !0))) : ((s.colWeekNumbersVisible = !1), (l = !1)),
                                (s.dayGrid = new S(s.context, c, {
                                    renderNumberIntroHtml: s.renderDayGridNumberIntroHtml,
                                    renderBgIntroHtml: s.renderDayGridBgIntroHtml,
                                    renderIntroHtml: s.renderDayGridIntroHtml,
                                    colWeekNumbersVisible: s.colWeekNumbersVisible,
                                    cellWeekNumbersVisible: l,
                                })),
                                s
                            );
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.dayGrid.destroy(), this.scroller.destroy();
                            }),
                            (r.prototype.renderSkeletonHtml = function () {
                                var e = this.theme;
                                return (
                                    '<table class="' +
                                    e.getClass("tableGrid") +
                                    '">' +
                                    (this.opt("columnHeader") ? '<thead class="fc-head"><tr><td class="fc-head-container ' + e.getClass("widgetHeader") + '">&nbsp;</td></tr></thead>' : "") +
                                    '<tbody class="fc-body"><tr><td class="' +
                                    e.getClass("widgetContent") +
                                    '"></td></tr></tbody></table>'
                                );
                            }),
                            (r.prototype.weekNumberStyleAttr = function () {
                                return null != this.weekNumberWidth ? 'style="width:' + this.weekNumberWidth + 'px"' : "";
                            }),
                            (r.prototype.hasRigidRows = function () {
                                var e = this.opt("eventLimit");
                                return e && "number" != typeof e;
                            }),
                            (r.prototype.updateSize = function (t, r, n) {
                                e.prototype.updateSize.call(this, t, r, n), this.dayGrid.updateSize(t);
                            }),
                            (r.prototype.updateBaseSize = function (e, r, n) {
                                var i,
                                    o,
                                    s = this.dayGrid,
                                    a = this.opt("eventLimit"),
                                    l = this.header ? this.header.el : null;
                                s.rowEls
                                    ? (this.colWeekNumbersVisible && (this.weekNumberWidth = t.matchCellWidths(t.findElements(this.el, ".fc-week-number"))),
                                      this.scroller.clear(),
                                      l && t.uncompensateScroll(l),
                                      s.removeSegPopover(),
                                      a && "number" == typeof a && s.limitRows(a),
                                      (i = this.computeScrollerHeight(r)),
                                      this.setGridHeight(i, n),
                                      a && "number" != typeof a && s.limitRows(a),
                                      n ||
                                          (this.scroller.setHeight(i),
                                          ((o = this.scroller.getScrollbarWidths()).left || o.right) && (l && t.compensateScroll(l, o), (i = this.computeScrollerHeight(r)), this.scroller.setHeight(i)),
                                          this.scroller.lockOverflow(o)))
                                    : n || ((i = this.computeScrollerHeight(r)), this.scroller.setHeight(i));
                            }),
                            (r.prototype.computeScrollerHeight = function (e) {
                                return e - t.subtractInnerElHeight(this.el, this.scroller.el);
                            }),
                            (r.prototype.setGridHeight = function (e, r) {
                                this.opt("monthMode") ? (r && (e *= this.dayGrid.rowCnt / 6), t.distributeHeight(this.dayGrid.rowEls, e, !r)) : r ? t.undistributeHeight(this.dayGrid.rowEls) : t.distributeHeight(this.dayGrid.rowEls, e, !0);
                            }),
                            (r.prototype.computeInitialDateScroll = function () {
                                return { top: 0 };
                            }),
                            (r.prototype.queryDateScroll = function () {
                                return { top: this.scroller.getScrollTop() };
                            }),
                            (r.prototype.applyDateScroll = function (e) {
                                void 0 !== e.top && this.scroller.setScrollTop(e.top);
                            }),
                            r
                        );
                    })(t.View);
                b.prototype.dateProfileGeneratorClass = o;
                var D = (function (e) {
                        function t(t, r) {
                            var n = e.call(this, t, r.el) || this;
                            return (n.slicer = new w()), (n.dayGrid = r), t.calendar.registerInteractiveComponent(n, { el: n.dayGrid.el }), n;
                        }
                        return (
                            n(t, e),
                            (t.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.calendar.unregisterInteractiveComponent(this);
                            }),
                            (t.prototype.render = function (e) {
                                var t = this.dayGrid,
                                    r = e.dateProfile,
                                    n = e.dayTable;
                                t.receiveProps(i({}, this.slicer.sliceProps(e, r, e.nextDayThreshold, t, n), { dateProfile: r, cells: n.cells, isRigid: e.isRigid }));
                            }),
                            (t.prototype.queryHit = function (e, t) {
                                var r = this.dayGrid.positionToHit(e, t);
                                if (r)
                                    return {
                                        component: this.dayGrid,
                                        dateSpan: r.dateSpan,
                                        dayEl: r.dayEl,
                                        rect: { left: r.relativeRect.left, right: r.relativeRect.right, top: r.relativeRect.top, bottom: r.relativeRect.bottom },
                                        layer: 0,
                                    };
                            }),
                            t
                        );
                    })(t.DateComponent),
                    w = (function (e) {
                        function t() {
                            return (null !== e && e.apply(this, arguments)) || this;
                        }
                        return (
                            n(t, e),
                            (t.prototype.sliceRange = function (e, t) {
                                return t.sliceRange(e);
                            }),
                            t
                        );
                    })(t.Slicer),
                    T = (function (e) {
                        function r(r, n, i, o) {
                            var s = e.call(this, r, n, i, o) || this;
                            return (s.buildDayTable = t.memoize(C)), s.opt("columnHeader") && (s.header = new t.DayHeader(s.context, s.el.querySelector(".fc-head-container"))), (s.simpleDayGrid = new D(s.context, s.dayGrid)), s;
                        }
                        return (
                            n(r, e),
                            (r.prototype.destroy = function () {
                                e.prototype.destroy.call(this), this.header && this.header.destroy(), this.simpleDayGrid.destroy();
                            }),
                            (r.prototype.render = function (t) {
                                e.prototype.render.call(this, t);
                                var r = this.props.dateProfile,
                                    n = (this.dayTable = this.buildDayTable(r, this.dateProfileGenerator));
                                this.header && this.header.receiveProps({ dateProfile: r, dates: n.headerDates, datesRepDistinctDays: 1 === n.rowCnt, renderIntroHtml: this.renderHeadIntroHtml }),
                                    this.simpleDayGrid.receiveProps({
                                        dateProfile: r,
                                        dayTable: n,
                                        businessHours: t.businessHours,
                                        dateSelection: t.dateSelection,
                                        eventStore: t.eventStore,
                                        eventUiBases: t.eventUiBases,
                                        eventSelection: t.eventSelection,
                                        eventDrag: t.eventDrag,
                                        eventResize: t.eventResize,
                                        isRigid: this.hasRigidRows(),
                                        nextDayThreshold: this.nextDayThreshold,
                                    });
                            }),
                            r
                        );
                    })(b);
                function C(e, r) {
                    var n = new t.DaySeries(e.renderRange, r);
                    return new t.DayTable(n, /year|month|week/.test(e.currentRangeUnit));
                }
                var R = t.createPlugin({
                    defaultView: "dayGridMonth",
                    views: {
                        dayGrid: T,
                        dayGridDay: { type: "dayGrid", duration: { days: 1 } },
                        dayGridWeek: { type: "dayGrid", duration: { weeks: 1 } },
                        dayGridMonth: { type: "dayGrid", duration: { months: 1 }, monthMode: !0, fixedWeekCount: !0 },
                    },
                });
                (e.default = R),
                    (e.SimpleDayGrid = D),
                    (e.DayGridSlicer = w),
                    (e.DayGrid = S),
                    (e.AbstractDayGridView = b),
                    (e.DayGridView = T),
                    (e.buildBasicDayTable = C),
                    (e.DayBgRow = g),
                    Object.defineProperty(e, "__esModule", { value: !0 });
            })(t, r(13));
        },
    });
    if ("object" == typeof r) {
        var n = ["object" == typeof module && "object" == typeof module.exports ? module.exports : null, "undefined" != typeof window ? window : null, e && e !== window ? e : null];
        for (var i in r) n[0] && (n[0][i] = r[i]), n[1] && "__esModule" !== i && (n[1][i] = r[i]), n[2] && (n[2][i] = r[i]);
    }
})(this);
