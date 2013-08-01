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
      file.puts YAML.dump({'layout' => 'post', 'published' => false, 'comments' => false, 'title' => title})
      file.puts "---"
    end
  end
  system `gedit #{path}`

  exit 1
end

task :build do
   desc "runs jekyll to generate _site/"
   system "jekyll build"
end

task :serve do
   desc "runs jekyll server with autoregen enabled"
   system "jekyll serve --watch"
end

task :deploy do
   desc "generates _site and sends it on remote server, also symlinks the comments database"
   sh "jekyll build && rsync -avz --delete _site/ /var/www/carnet"
   sh "ln -s /var/www/commentcava.sqlite /var/www/carnet/comments/commentcava.sqlite"
end
