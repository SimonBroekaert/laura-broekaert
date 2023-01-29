import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-youtube', IndexField)
  app.component('detail-youtube', DetailField)
  app.component('form-youtube', FormField)
})
