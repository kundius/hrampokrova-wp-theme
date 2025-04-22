import 'normalize.css'
import './src/styles/main.scss'
import './src/images/logo.png'
import './src/images/logo-small.png'
import './src/images/sprite.svg'
import { initStickyHeader } from './src/scripts/sticky-header'
import { initScheduleCarousel } from './src/scripts/schedule-carousel'
import fslightbox from 'fslightbox'
import { initMobileMenu } from './src/scripts/mobile-menu'
import { initSnow } from './src/scripts/snow'
import { initHomePreachingCarousel } from './src/scripts/home-preaching-carousel'
import { initShrineCarousel } from './src/scripts/shrine-carousel'
import { initNotesForm } from './src/scripts/notes-form'
import { initFaq } from './src/scripts/faq'
import { initQuestionForm } from './src/scripts/question-form'
import { initPhotoalbumCarousel } from './src/scripts/photoalbum-carousel'

initStickyHeader()
initNotesForm()
initQuestionForm()
initMobileMenu()
initSnow()
initScheduleCarousel()
initHomePreachingCarousel()
initShrineCarousel()
initFaq()
initPhotoalbumCarousel()
