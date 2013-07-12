guard :livereload do
  watch(%r{.+\.(php|inc|css|js)$})
end

guard :compass, input: 'assets/sass', output: 'css' do
  watch(%r{assets/css/(.*)\.s[ac]ss$})
end

guard :coffeescript, input: 'assets/coffee', output: 'js' do
  watch(%r{assets/js/(.*)\.coffee$})
end
