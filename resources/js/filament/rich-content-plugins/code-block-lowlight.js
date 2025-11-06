import { CodeBlockLowlight } from '@tiptap/extension-code-block-lowlight';
import { common, createLowlight } from 'lowlight';

const lowlight = createLowlight(common);

export default CodeBlockLowlight.configure({
    lowlight,
    enableTabIndentation: true,
    tabSize: 2,
    languageClassPrefix: 'hljs language-',
    defaultLanguage: 'php',
    HTMLAttributes: {
      class: 'hljs',
    },
});