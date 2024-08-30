<script setup>
import {
  BalloonEditor,
  Autoformat,
  Bold,
  Italic,
  BlockQuote,
  Base64UploadAdapter,
  CKFinder,
  CKFinderUploadAdapter,
  CloudServices,
  Essentials,
  Heading,
  Image,
  ImageCaption,
  ImageStyle,
  ImageToolbar,
  ImageUpload,
  PictureEditing,
  Indent,
  IndentBlock,
  Link,
  List,
  Mention,
  Paragraph,
  PasteFromOffice,
  Table,
  TableToolbar,
  TextTransformation,
  BlockToolbar,
  ImageResizeEditing,
  ImageResizeHandles,
  Underline,
  Strikethrough,
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';

const config = {
  plugins: [
    Autoformat,
    BlockQuote,
    BlockToolbar,
    Bold,
    CKFinder,
    CKFinderUploadAdapter,
    CloudServices,
    Essentials,
    Heading,
    Image,
    ImageCaption,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
    Base64UploadAdapter,
    ImageResizeEditing,
    ImageResizeHandles,
    Indent,
    IndentBlock,
    Italic,
    Link,
    List,
    Mention,
    Paragraph,
    PasteFromOffice,
    PictureEditing,
    Strikethrough,
    Table,
    TableToolbar,
    TextTransformation,
    Underline
  ],
  blockToolbar: [
    'undo',
    'redo',
    '|',
    // 'heading',
    // '|',
    'uploadImage',
    'blockQuote',
    '|',
    'bulletedList',
    'numberedList',
    'outdent',
    'indent',
  ],
  placeholder: 'Start writing...',
  toolbar: {
    items: ['bold', 'italic', 'underline', 'link', 'strikethrough'],
  },
  // heading: {
  //   options: [
  //     {
  //       model: 'paragraph',
  //       title: 'Paragraph',
  //       class: 'ck-heading_paragraph',
  //     },
  //     {
  //       model: 'heading1',
  //       view: 'h1',
  //       title: 'Heading 1',
  //       class: 'ck-heading_heading1',
  //     },
  //     {
  //       model: 'heading2',
  //       view: 'h2',
  //       title: 'Heading 2',
  //       class: 'ck-heading_heading2',
  //     },
  //     {
  //       model: 'heading3',
  //       view: 'h3',
  //       title: 'Heading 3',
  //       class: 'ck-heading_heading3',
  //     },
  //     {
  //       model: 'heading4',
  //       view: 'h4',
  //       title: 'Heading 4',
  //       class: 'ck-heading_heading4',
  //     },
  //   ],
  // },
  image: {
    toolbar: [
      'imageStyle:inline',
      'imageStyle:block',
      '|',
      'toggleImageCaption',
      'imageTextAlternative',
    ],
  },
  link: {
    addTargetToExternalLinks: true,
    defaultProtocol: 'https://',
  },
}

const body = defineModel()
defineProps(['error'])
</script>
<template>
  <ckeditor v-if="error" :editor="BalloonEditor" :config="config" v-model="body" class="error" />
  <ckeditor v-else :editor="BalloonEditor" :config="config" v-model="body" />
</template>
<style>
.ck.ck-editor__editable.ck-focused:not(.ck-editor__nested-editable),
.ck.ck-editor__editable {
  border: none;
  outline: none;
  box-shadow: none;
  border-radius: 8px;
  min-height: 200px;
}

.ck-rounded-corners {
  --ck-border-radius: 8px;
}

.error.ck.ck-editor__editable.ck-focused:not(.ck-editor__nested-editable),
.error.ck.ck-editor__editable {
  border: 1px solid #dc2626;
  border-radius: 8px;
  min-height: 200px;
}

.section .ck.ck-editor__editable.ck-focused:not(.ck-editor__nested-editable),
.section .ck.ck-editor__editable {
  min-height: 120px;
}
</style>