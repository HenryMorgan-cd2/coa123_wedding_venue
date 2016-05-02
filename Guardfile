# Sample guardfile block for Guard::Haml
# You can use some options to change guard-haml configuration
# output: 'public'                   set output directory for compiled files
# input: 'src'                       set input directory with haml files
# run_at_start: true                 compile files when guard starts
# notifications: true                send notifictions to Growl/libnotify/Notifu
# haml_options: { ugly: true }    pass options to the Haml engine

require 'haml/filters'
require 'haml/filters/php'

guard 'haml', haml_options: { escape_attrs: false }

guard :haml do
  watch(/^.+(\.haml)$/)
end

module ::Haml::Helpers
  def php(text, &block)
    html = "<?php #{text} ?>"
    if block
      inner = capture_haml &block
      html << "\n\t" + inner
    end
    return html
  end

  def php_echo(text)
    php %(echo #{text})
  end

  def php_echo_var(var)
    php %(if (isset(#{var})) echo #{var};)
  end

  def uh haml
    ::Haml::Engine.new(haml, :escape_attrs => false).to_html
  end

end

guard 'sass', :input => 'wedding'
