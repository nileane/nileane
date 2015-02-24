require 'rubygems'
require 'optparse'
require 'yaml'

task :post do
  OptionParser.new.parse!
  ARGV.shift
  title = ARGV.join(' ')

  path = "_posts/#{Date.today}-#{title.downcase.gsub(/[^[:alnum:]]+/, '-')}.markdown"
  
  if File.exist?(path)
   puts "[WARN] File exists - skipping create"
  else
    File.open(path, "w") do |file|
      file.puts YAML.dump({'layout' => 'post', 'published' => false, 'headimg_url' => '', 'headimg_lic' => '', 'headimg_lic_url' => '', 'title' => title})
      file.puts "---"
    end
  end
  
  exit 1
end

task :build do
   desc "runs jekyll to generate _site/"
   system "jekyll build"
end

task :deploy do
   desc "runs git to pull new code & jekyll to generate _site/"
   system "git pull && jekyll build"
end

task :serve do
   desc "runs jekyll server with autoregen enabled"
   system "jekyll serve --watch"
end
